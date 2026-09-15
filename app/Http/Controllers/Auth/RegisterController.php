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

        // v2 intentionally starts fresh. The earlier limiter counted ordinary
        // validation retries and could leave genuine customers locked out.
        $ipKey = 'register:v2:ip:' . sha1($ip);
        $emailKey = 'register:v2:email:' . sha1($email);
        $phoneKey = 'register:v2:phone:' . sha1($phone);

        $riskScore = 0;
        $reasons = [];

        // Honeypot is a strong bot signal.
        if (!empty($data['website'])) {
            $riskScore += 100;
            $reasons[] = 'honeypot_filled';
        }

        // Client time is useful as a supporting signal only. It must never be a
        // single-point failure because device clocks can be wrong.
        $startedAt = isset($data['registration_started_at'])
            ? (int) $data['registration_started_at']
            : 0;
        $nowMs = (int) round(microtime(true) * 1000);

        if ($startedAt <= 0 || $startedAt > ($nowMs + 300000)) {
            $riskScore += 20;
            $reasons[] = 'invalid_form_timer';
        } else {
            $elapsedSeconds = (int) floor(($nowMs - $startedAt) / 1000);

            if ($elapsedSeconds < 2) {
                $riskScore += 15;
                $reasons[] = 'submitted_too_fast';
            }

            // No maximum form age: customers may browse or leave the page open.
        }

        if (!$request->userAgent()) {
            $riskScore += 100;
            $reasons[] = 'missing_user_agent';
        }

        if ($this->looksLikeSpamInput($data)) {
            $riskScore += 100;
            $reasons[] = 'spam_input_pattern';
        }

        // The browser must have completed the visible challenge. We do not claim
        // this is cryptographic verification without Google siteverify; it is one
        // layer alongside the honeypot, timing and local rate controls.
        $recaptchaToken = trim((string) ($data['g-recaptcha-response'] ?? ''));
        if (strlen($recaptchaToken) < 80) {
            $riskScore += 100;
            $reasons[] = 'missing_browser_challenge';
        }

        // Identity limits are stronger than IP limits because a shared office,
        // mobile carrier or proxy can legitimately put many people behind one IP.
        if ($email !== '' && RateLimiter::tooManyAttempts($emailKey, 10)) {
            $riskScore += 100;
            $reasons[] = 'email_rate_limit';
        }

        if ($phone !== '' && RateLimiter::tooManyAttempts($phoneKey, 10)) {
            $riskScore += 100;
            $reasons[] = 'phone_rate_limit';
        }

        // A noisy IP is only a supporting signal. It cannot block a customer by
        // itself, which avoids the false-positive shown on shared/proxied networks.
        if ($ip !== '' && RateLimiter::tooManyAttempts($ipKey, 40)) {
            $riskScore += 25;
            $reasons[] = 'ip_rate_limit';
        }

        if ($riskScore >= 80) {
            Log::warning('Registration blocked by custom bot check', [
                'ip' => $ip,
                'email' => $data['email'] ?? null,
                'score' => $riskScore,
                'reasons' => $reasons,
            ]);

            return true;
        }

        // Count only requests that made it through normal Laravel validation and
        // the local bot decision. Failed field validation no longer burns attempts.
        RateLimiter::hit($ipKey, 900);
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
