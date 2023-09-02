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
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        $user =  User::create([
            'name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'type' => 'subscriber',
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number']
        ]);



        $email = $data['email'];
        $list_id = config('services.mailchimp.list');
        $api_key = config('services.mailchimp.secret');

        $data_center = substr($api_key, strpos($api_key, '-') + 1);

        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';

        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed', //pass 'subscribed' or 'pending'
            'merge_fields'  => [
                'FNAME' =>  $data['first_name'],
                'LNAME' =>  $data['last_name']
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


        $coupon = new Voucher;
        $coupon->code =  str_random(6);
        $coupon->user_id = $user->id;
        $coupon->amount = 5;
        $coupon->type = 'specific';
        $coupon->expires = now()->addDays(365);
        $coupon->from_value = null;
        $coupon->is_fixed = 0;
        $coupon->status = 1;
        $coupon->save();

        $user->coupon = $coupon->code;

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
