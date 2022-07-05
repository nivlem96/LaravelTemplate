<?php

namespace App\Http\Requests\Authenticate;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:' . User::PASSWORD_MIN_LENGTH,
        ];
    }

    public function register()
    {
        $data = $this->validated();

        if ($this->createUser($data)) {
            return redirect()->route('dashboard')->withSuccess('have signed-in');
        }

        return redirect()->route('register')->withErrors(__('validation.errors.user_creation_failed'));
    }

    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
