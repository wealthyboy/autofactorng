<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;


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

    public function showLoginForm()
    {
        $token = request()->query('token');
        $forum = request()->query('forum');


        if (hash_equals(csrf_token(), $token) &&  $forum) {
            session()->put('forum', true);
        }
        return view('auth.login');
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

        if (null !== $user && $user->is_old == true && $user->is_updated == false) {
            $response = Http::get("https://autofactorng.com/apilogin.php?pword={$request->password}&uname={$request->email}");

            $response = $response->body();
            if ($response == "logged in") {
                $user->password = bcrypt($request->password);
                $user->is_updated = 1;
                $user->save();

                if ($this->attemptLogin($request)) {
                    if ($request->ajax()) {
                        return response()->json([
                            'loggenIn' => true,
                            'url' => \Session::get('url.intended', url('/'))
                        ]);
                    }
                    return $this->sendLoginResponse($request);
                }
            }
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
                    'url' => \Session::get('url.intended', url('/')),
                    'forum' => session('forum')
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

    public function logout(Request $request)
    {

        $carts = Cart::where(['user_id' => optional(auth()->user())->id])->get();
        Cart::hide($carts);

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
