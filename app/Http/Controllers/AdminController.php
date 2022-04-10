<?php

namespace App\Http\Controllers;

use App\Helpers\ClassHelper;
use App\Models\Permission;
use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        if ($authUser->cant([ClassHelper::getClassName(new User()), Permission::KEY_ACCESS_OTHER])) {
            abort(403);
        }

        $users = User::all();

        return view('admin.users', [
            'authUser' => $authUser,
            'users' => $users,
        ]);
    }
}
