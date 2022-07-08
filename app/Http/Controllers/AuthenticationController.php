<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthenticationController extends Controller
{
    // Login basic
    public function login_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-login-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Login Cover
    public function login_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-login-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Register basic
    public function register_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-register-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Register cover
    public function register_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-register-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        return Redirect::to("/")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = array(
            'username'      => $request->input('username'),
            'email'         => $request->input('email'),
            'password'      => $request->input('password'),
            'created_by'    => 'hendry',
            'updated_by'    => 'hendry'
        );

        $check = $this->create($data);

        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }

    // Forgot Password basic
    public function forgot_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Forgot Password cover
    public function forgot_password_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password basic
    public function reset_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password cover
    public function reset_password_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // email verify basic
    public function verify_email_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-verify-email-basic', ['pageConfigs' => $pageConfigs]);
    }

    // email verify cover
    public function verify_email_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-verify-email-cover', ['pageConfigs' => $pageConfigs]);
    }

    // two steps basic
    public function two_steps_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-two-steps-basic', ['pageConfigs' => $pageConfigs]);
    }

    // two steps cover
    public function two_steps_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-two-steps-cover', ['pageConfigs' => $pageConfigs]);
    }

    // register multi steps
    public function register_multi_steps()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-register-multisteps', ['pageConfigs' => $pageConfigs]);
    }
}
