<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\PostRequest;
use App\Models\Image;
use App\Models\Permission;

class ImageController extends Controller
{
    public function image(int $id)
    {
        if (!$this->authUser->can(['Image', Permission::KEY_ACCESS])) {
            return redirect()->route('dashboard');
        }

        return view('image.detail', [
            'image' => Image::query()->findOrFail($id),
        ]);
    }

    public function postImage(PostRequest $request)
    {
        return $request->postImage();
    }

    public function deleteImage($id)
    {
        $image = Image::query()->findOrFail($id);
        $image->delete();

        return redirect(route('images'));
    }
}
