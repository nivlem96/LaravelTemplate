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
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function resetPassword(string $token)
    {
        return view('reset-password', ['token' => $token]);
    }
}
