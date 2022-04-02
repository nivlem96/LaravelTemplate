<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticatedController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('home');
    }
}
