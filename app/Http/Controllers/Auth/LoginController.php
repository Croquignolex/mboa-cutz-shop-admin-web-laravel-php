<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return Application|Factory|Response|View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * @param LoginRequest $request
     * @return Response|void
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        $this->sendFailedLoginResponse();
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param Request $request
     * @return void
     *
     * @throws ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $message = "Nombre de requettes trop importante";
        danger_flash_message($message);
        throw ValidationException::withMessages([$this->username() => [$message]]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $user = User::where(['email' => $credentials['email']])->first();
        if($user !== null)
        {
            if($user->role->type !== Role::USER) {
                return $this->guard()->attempt($this->credentials($request));
            }
        }
        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect(route('login'));
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['is_confirmed'] = true;
        return $credentials;
    }

    /**
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse()
    {
        $message = "Combinaison email et mot de passe incorrect ou votre à été bloqué";
        danger_flash_message($message);
        throw ValidationException::withMessages([$this->username() => [$message]]);
    }

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        info_flash_message("Bienvenue {$user->name}");
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('dashboard.index');
    }
}