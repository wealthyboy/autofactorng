<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Voucher;
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
        $user = User::where('email', 'jacobanusa@gmail.com')->first();

        if ($user) {
            $user->delete();
        }
        return Validator::make($data, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'g-recaptcha-response' => ['required', 'string'],
        ]);
    }

    protected function verifyRecaptcha($token)
    {
        $secret = config('services.recaptcha.secret');
        if (!$secret || !$token) {
            Log::warning('reCAPTCHA verification prerequisites missing', [
                'has_secret' => (bool) $secret,
                'has_token' => (bool) $token,
            ]);
            return false;
        }

        $requestIp = request()->ip();

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => $requestIp,
                ]);

            Log::info($response);
            if (!$response->ok()) {
                Log::warning('reCAPTCHA verification HTTP failure', [
                    'status' => $response->status(),
                ]);
                return false;
            }

            $body = $response->json();
            $isSuccess = isset($body['success']) && $body['success'] === true;

            if (!$isSuccess) {
                Log::warning('reCAPTCHA rejected by Google', [
                    'error_codes' => $body['error-codes'] ?? [],
                    'hostname' => $body['hostname'] ?? null,
                    'client_ip' => $requestIp,
                ]);
            }

            return $isSuccess;
        } catch (\Throwable $exception) {
            Log::info($exception);
            return false;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Verify reCAPTCHA before creating user
        // if (!$this->verifyRecaptcha($data['g-recaptcha-response'] ?? '')) {
        // throw new \Exception('reCAPTCHA verification failed');
        // }

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
            $coupon = new Voucher;
            $coupon->code = str_random(6);
            $coupon->user_id = $user->id;
            $coupon->amount = 5;
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
