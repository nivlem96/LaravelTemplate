<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class PublicController extends BaseController
{
    public function home()
    {
        return view('home');
    }
}
