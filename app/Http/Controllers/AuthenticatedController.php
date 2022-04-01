<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticatedController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('are not allowed to access');
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
