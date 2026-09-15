<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Promo;
use App\Notifications\WelcomeNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;
use App\Services\Newsletter\MailChimpNewsletter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Mailchimp;
use Mailchimp_Lists;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public $newsletter;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        // $this->newsletter = $newsletter;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'website' => ['nullable', 'string', 'max:255'],
            'fax_number' => ['nullable', 'string', 'max:255'],
            // These two fields are produced by the real registration UI.
            // They are deliberately validated locally; Google siteverify is not
            // used because the production server-side Google call was unreliable.
            'registration_started_at' => ['required', 'integer'],
            // We do not call Google's siteverify endpoint in production, but
            // a genuine v2 browser token is substantially longer than a hand-made
            // placeholder. This remains only one signal in the local verifier.
            'g-recaptcha-response' => ['required', 'string', 'min:80'],
        ]);

        $validator->after(function ($validator) use ($data) {
            // Do not consume anti-bot attempts when ordinary form validation
            // already failed (duplicate email, password confirmation, etc.).
            // A genuine customer must be able to correct a field and resubmit.
            if ($validator->errors()->count() > 0) {
                return;
            }

            if ($this->isBotRegistration($data, request())) {
                $validator->errors()->add(
                    'registration',
                    'We could not verify this registration. Please complete the verification again and try once more.'
                );
            }
        });

        return $validator;
    }

    protected function isBotRegistration(array $data, Request $request): bool
    {
        // Keep the anti-bot decision local to AutofactorNG. Google siteverify is
        // intentionally NOT called because that production request was unreliable.
        $ip = (string) $request->ip();
        $email = strtolower(trim((string) ($data['email'] ?? '')));
        $phone = preg_replace('/\D+/', '', (string) ($data['phone_number'] ?? ''));

        // v3 starts clean after the earlier limiter/risk-score false positives.
        $ipKey = 'register:v3:ip:' . sha1($ip);
        $emailKey = 'register:v3:email:' . sha1($email);
        $phoneKey = 'register:v3:phone:' . sha1($phone);

        $hardReasons = [];
        $softReasons = [];

        // New honeypot name is deliberately unrelated to normal browser profile
        // fields. The old `website` honeypot was vulnerable to autofill and is now
        // only logged as a legacy signal instead of blocking a genuine customer.
        if (!empty($data['fax_number'])) {
            $hardReasons[] = 'honeypot_filled';
        }

        if (!empty($data['website'])) {
            $softReasons[] = 'legacy_honeypot_filled';
        }

        $startedAt = isset($data['registration_started_at'])
            ? (int) $data['registration_started_at']
            : 0;
        $nowMs = (int) round(microtime(true) * 1000);

        // Timing is diagnostic only. Device clocks, cached tabs and autofill must
        // never be enough to reject an otherwise valid registration.
        if ($startedAt <= 0 || $startedAt > ($nowMs + 300000)) {
            $softReasons[] = 'invalid_form_timer';
        } else {
            $elapsedSeconds = (int) floor(($nowMs - $startedAt) / 1000);
            if ($elapsedSeconds < 2) {
                $softReasons[] = 'submitted_too_fast';
            }
        }

        // Some proxies/privacy tools can alter request headers, so missing UA is
        // logged but is not a single-point blocker.
        if (!$request->userAgent()) {
            $softReasons[] = 'missing_user_agent';
        }

        // Active HTML/script/URL payloads in identity fields are strong evidence
        // that this is not a normal customer registration.
        if ($this->looksLikeSpamInput($data)) {
            $hardReasons[] = 'spam_input_pattern';
        }

        // The Vue form requires completion of the visible challenge. This is not
        // a substitute for Google server verification; it is one local layer.
        $recaptchaToken = trim((string) ($data['g-recaptcha-response'] ?? ''));
        if (strlen($recaptchaToken) < 80) {
            $hardReasons[] = 'missing_browser_challenge';
        }

        // Only repeated attempts against the SAME identity can hard-block. Normal
        // Laravel field errors do not consume these counters (see validator()).
        if ($email !== '' && RateLimiter::tooManyAttempts($emailKey, 20)) {
            $hardReasons[] = 'email_rate_limit';
        }

        if ($phone !== '' && RateLimiter::tooManyAttempts($phoneKey, 20)) {
            $hardReasons[] = 'phone_rate_limit';
        }

        // IP activity is useful for diagnostics, but mobile carriers, offices and
        // proxies can place many genuine customers behind one address. Never block
        // a customer on IP volume alone.
        if ($ip !== '' && RateLimiter::tooManyAttempts($ipKey, 100)) {
            $softReasons[] = 'ip_rate_limit';
        }

        if (!empty($hardReasons)) {
            Log::warning('Registration blocked by custom bot check', [
                'ip' => $ip,
                'email' => $data['email'] ?? null,
                'hard_reasons' => $hardReasons,
                'soft_reasons' => $softReasons,
            ]);

            return true;
        }

        if (!empty($softReasons)) {
            Log::info('Registration passed with soft bot signals', [
                'ip' => $ip,
                'email' => $data['email'] ?? null,
                'reasons' => $softReasons,
            ]);
        }

        // Count only syntactically valid registrations that passed the hard bot
        // checks. Field-validation failures never burn these attempts.
        if ($ip !== '') {
            RateLimiter::hit($ipKey, 900);
        }
        if ($email !== '') {
            RateLimiter::hit($emailKey, 900);
        }
        if ($phone !== '') {
            RateLimiter::hit($phoneKey, 900);
        }

        return false;
    }

    protected function looksLikeSpamInput(array $data): bool
    {
        $fields = [
            $data['first_name'] ?? '',
            $data['last_name'] ?? '',
            $data['email'] ?? '',
            $data['phone_number'] ?? '',
        ];

        foreach ($fields as $field) {
            if (preg_match('/https?:\/\/|<a\s|<\/a>|<script|<\/script>/i', (string) $field)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'type' => 'subscriber',
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'is_indrive_customer' => (bool) session('is_indrive_customer'),
            'acquisition_source' => session('acquisition_source'),
            'acquisition_source_at' => session('acquisition_source_at') ? now() : null,
            'indrive_session_id' => session('indrive_session_id'),
            'indrive_driver_id' => session('indrive_driver_id'),
        ]);



        $email = $data['email'];
        $list_id = config('services.mailchimp.list');
        $api_key = config('services.mailchimp.secret');
        $data_center = substr($api_key, strpos($api_key, '-') + 1);

        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';

        $json = json_encode([
            'email_address' => $email,
            'status' => 'subscribed', //pass 'subscribed' or 'pending'
            'merge_fields' => [
                'FNAME' => $data['first_name'],
                'LNAME' => $data['last_name']
            ]
        ]);

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            $result = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } catch (\Exception $e) {
            Log::info($e);
        }

        $res = $this->sendToTermii($data, $user);

        if (! $user->is_indrive_customer) {
            $welcomePromo = Promo::query()
                ->where('is_active', true)
                ->latest('updated_at')
                ->first();

            $welcomeDiscountPercent = (int) ($welcomePromo->coupon_percent ?? 5);
            $welcomeDiscountPercent = max(1, min(100, $welcomeDiscountPercent));

            $coupon = new Voucher;
            $coupon->code = str_random(6);
            $coupon->user_id = $user->id;
            $coupon->amount = $welcomeDiscountPercent;
            $coupon->type = 'specific';
            $coupon->expires = now()->addDays(365);
            $coupon->from_value = null;
            $coupon->is_fixed = 0;
            $coupon->status = 1;
            $coupon->belongs_to_user = 1;
            $coupon->save();
            $user->coupon = $coupon->code;
            $user->save();
        }

        $user->notify(new WelcomeNotification($user));

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function sendToTermii(array $data, User $user)
    {
        $apiKey = config('services.termii.api_key');
        $phonebookId = config('services.termii.phonebook_id');

        // dd($apiKey, $phonebookId);

        if (!$apiKey || !$phonebookId) {
            Log::warning('Termii config missing; skipping Termii contact creation.', [
                'api_key_set' => (bool) $apiKey,
                'phonebook_id_set' => (bool) $phonebookId,
            ]);
            return;
        }

        $phoneNumber = $this->normalizePhoneNumber($data['phone_number']);

        $payload = [
            'api_key' => $apiKey,
            'phone_number' => $phoneNumber,
            'email_address' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'company' => config('services.termii.company'),
            'country_code' => config('services.termii.country_code'),
        ];

        $url = 'https://termii.com/api/phonebooks/' . $phonebookId . '/contacts';

        // try {
        $response = Http::timeout(10)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $payload);


        if (!$response->successful()) {
            Log::warning('Termii contact creation failed', [
                'url' => $url,
                'payload' => $payload,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
        // } catch (\Throwable $e) {
        //     Log::warning('Termii contact creation error', [
        //         'message' => $e->getMessage(),
        //         'payload' => $payload,
        //     ]);
        // }
    }

    protected function normalizePhoneNumber(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if (strlen($digits) === 11 && substr($digits, 0, 1) === '0') {
            return substr($digits, 1);
        }

        if (strlen($digits) === 13 && substr($digits, 0, 3) === '234') {
            return substr($digits, 3);
        }

        return $digits;
    }

    protected function registered(Request $request, $user)
    {
        if ($request->ajax()) {
            return response()->json([
                'loggenIn' => true,
                'user' => auth()->user(),
                'url' => \Session::get('url.intended', url('/'))
            ], 200);
        }
        return redirect()->intended($this->redirectPath());
    }
}
