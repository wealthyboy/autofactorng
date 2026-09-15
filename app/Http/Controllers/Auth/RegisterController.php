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
use Illuminate\Support\Facades\Http;
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
            'g-recaptcha-response' => ['required', 'string'],
        ]);

        $validator->after(function ($validator) use ($data) {
            // Do not call Google when the normal registration fields already
            // contain errors. The customer should be able to fix those fields
            // without unnecessarily consuming a one-time reCAPTCHA token.
            if ($validator->errors()->count() > 0) {
                return;
            }

            // Keep a tiny local sanity check, but let Google be the authority on
            // whether the visible challenge is genuine. Do not use timing, user
            // agent, proxy/IP or hidden-field scoring to reject real customers.
            if ($this->looksLikeSpamInput($data)) {
                Log::warning('Registration blocked by obvious spam input', [
                    'ip' => request()->ip(),
                    'email' => $data['email'] ?? null,
                ]);

                $validator->errors()->add(
                    'registration',
                    'We could not verify this registration. Please review your details and try again.'
                );
                return;
            }

            $verification = $this->verifyRecaptcha(
                (string) ($data['g-recaptcha-response'] ?? '')
            );

            if (!$verification['success']) {
                $validator->errors()->add(
                    'g-recaptcha-response',
                    $verification['message']
                );
            }
        });

        return $validator;
    }

    /**
     * Verify a reCAPTCHA v2 token with Google.
     *
     * Google response tokens are short-lived and single-use. The client resets
     * the widget whenever verification fails so a genuine customer can solve a
     * fresh challenge without losing the rest of the registration form.
     */
    protected function verifyRecaptcha(string $token): array
    {
        $token = trim($token);
        $secret = trim((string) config('services.recaptcha.secret'));

        if ($token === '') {
            return [
                'success' => false,
                'message' => 'Please complete the reCAPTCHA verification.',
                'code' => 'missing-token',
            ];
        }

        if ($secret === '') {
            Log::error('reCAPTCHA server verification is not configured: RECAPTCHA_SECRET_KEY is missing.');

            return [
                'success' => false,
                'message' => 'The verification service is not configured correctly. Please try again later.',
                'code' => 'missing-secret',
            ];
        }

        try {
            // remoteip is intentionally omitted. Google documents it as optional,
            // and AutofactorNG can sit behind proxies/mobile carrier NAT where the
            // application-visible IP may not reliably represent the browser.
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secret,
                    'response' => $token,
                ]);
        } catch (\Throwable $exception) {
            Log::error('reCAPTCHA request to Google failed', [
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
            ]);

            return [
                'success' => false,
                'message' => 'Google reCAPTCHA could not be reached. Please try again in a moment.',
                'code' => 'transport-error',
            ];
        }

        if (!$response->successful()) {
            Log::error('reCAPTCHA Google endpoint returned an HTTP error', [
                'status' => $response->status(),
                'body' => mb_substr($response->body(), 0, 500),
            ]);

            return [
                'success' => false,
                'message' => 'Google reCAPTCHA could not be reached. Please try again in a moment.',
                'code' => 'http-error',
            ];
        }

        $body = $response->json();
        $errorCodes = array_values((array) ($body['error-codes'] ?? []));
        $success = isset($body['success']) && $body['success'] === true;

        if ($success) {
            Log::info('reCAPTCHA registration verification passed', [
                'hostname' => $body['hostname'] ?? null,
                'challenge_ts' => $body['challenge_ts'] ?? null,
            ]);

            return [
                'success' => true,
                'message' => null,
                'code' => null,
            ];
        }

        Log::warning('reCAPTCHA registration verification rejected by Google', [
            'error_codes' => $errorCodes,
            'hostname' => $body['hostname'] ?? null,
            'challenge_ts' => $body['challenge_ts'] ?? null,
        ]);

        if (in_array('timeout-or-duplicate', $errorCodes, true)) {
            return [
                'success' => false,
                'message' => 'reCAPTCHA expired or was already used. Please check “I’m not a robot” again.',
                'code' => 'timeout-or-duplicate',
            ];
        }

        if (
            in_array('missing-input-secret', $errorCodes, true) ||
            in_array('invalid-input-secret', $errorCodes, true)
        ) {
            return [
                'success' => false,
                'message' => 'The verification service is not configured correctly. Please try again later.',
                'code' => 'invalid-secret',
            ];
        }

        if (
            in_array('missing-input-response', $errorCodes, true) ||
            in_array('invalid-input-response', $errorCodes, true)
        ) {
            return [
                'success' => false,
                'message' => 'Google could not verify the challenge. Please complete reCAPTCHA again.',
                'code' => 'invalid-response',
            ];
        }

        return [
            'success' => false,
            'message' => 'Google could not verify the challenge. Please complete reCAPTCHA again.',
            'code' => 'verification-failed',
        ];
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
