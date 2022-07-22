<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function login()
    {
        if (Auth::attempt($this->validated())) {
            return redirect()->route('dashboard')
                             ->withSuccess('Signed in');
        }

        return redirect()->route('login')->withErrors('Login details are not valid');
    }
}
