<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;

class UserController extends Controller
{
    public function deleteUser(int $id)
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        if (($id === $authUser->id && $authUser->can('User', Permission::KEY_DELETE)) || $authUser->can(['User', Permission::KEY_DELETE_OTHER])) {
            User::query()->where('id', $id)->delete();
            if ($id === $authUser->id) {
                return redirect(route('signOut'));
            }
        }
        if ($authUser->can(['User', Permission::KEY_ACCESS_OTHER])) {
            return redirect(route('users'));
        }

        return redirect(route('dashboard'));
    }
}
