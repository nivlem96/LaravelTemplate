<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class PublicController extends BaseController
{
    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
}
