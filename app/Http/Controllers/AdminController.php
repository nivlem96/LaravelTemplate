<?php

namespace App\Http\Controllers;

use App\Helpers\ClassHelper;
use App\Models\Image;
use App\Models\Log;
use App\Models\Permission;
use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        if (!$this->authUser->can([ClassHelper::getClassName(new User()), Permission::KEY_ACCESS_OTHER])) {
            abort(403);
        }

        return view('admin.users', [
            'authUser' => $this->authUser,
            'users' => User::all(),
        ]);
    }

    public function logs()
    {
        if (!$this->authUser->can(['Log', Permission::KEY_ACCESS])) {
            return redirect()->route('dashboard');
        }

        return view('admin.logs', [
            'logs' => Log::query()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function log(int $id)
    {
        if (!$this->authUser->can(['Log', Permission::KEY_ACCESS])) {
            return redirect()->route('dashboard');
        }

        return view('log.detail', [
            'log' => Log::query()->findOrFail($id),
        ]);
    }

    public function images()
    {
        if (!$this->authUser->can(['Image', Permission::KEY_ACCESS])) {
            return redirect()->route('dashboard');
        }

        return view('admin.images', [
            'images' => Image::query()->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
