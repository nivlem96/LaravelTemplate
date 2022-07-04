<?php

namespace App\Http\Controllers;


use App\Http\Requests\Authenticate\ForgotPasswordRequest;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Http\Requests\Authenticate\RegisterRequest;
use App\Http\Requests\Authenticate\ResetPasswordRequest;

class AuthenticateController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $request->login();
    }

    public function register(RegisterRequest $request)
    {
        return $request->register();
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        return $request->forgotPassword();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return $request->resetPassword();
    }
}
