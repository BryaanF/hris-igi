<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        // validate stored temporary data lgon
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // store temporary data login
        $data = $request->all();

        if (Auth::attempt($credentials)) {
            if (isset($data['rememberme']) && !empty($data['rememberme'])) {
                setcookie("email", $data['email'], time() + 172800);
            } else {
                setcookie("email", "");
                setcookie("password", "");
            }
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'Data login yang diinputkan tidak ada.',
        ])->onlyInput('email');
    }
}
