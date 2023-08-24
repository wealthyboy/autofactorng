<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();
        dd($user);

        if (null !== $user && $user->is_old == true && $user->is_updated == false) {
            // $response = Http::get("https://autofactorng.com/apilogin.php?pword={$request->password}&uname={$request->email}");

            if (sha1($request->password) == $user->old_password) {
                dd(true);
            }


            $user->password = bcrypt($request->password);
            $user->is_updated = 1;
            $user->save();
        }



        if ($this->attemptLogin($request)) {
            if ($request->ajax()) {
                return response()->json([
                    'loggenIn' => true,
                    'url' => \Session::get('url.intended', url('/'))
                ]);
            }
            return $this->sendLoginResponse($request);
        }



        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->ajax()) {
                return response()->json([
                    'loggenIn' => true,
                    'url' => \Session::get('url.intended', url('/'))
                ]);
            }
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
