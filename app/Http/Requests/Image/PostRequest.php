<?php

namespace App\Http\Requests\Image;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class PostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
        ];
    }

    public function postImage()
    {
        $validated = $this->validated();
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $validated['image'];
        $sizes = getimagesize($uploadedFile);
        $folder = 'images' . DIRECTORY_SEPARATOR . 'uploaded';
        /** @var File $file */
        $file = $uploadedFile->move(public_path($folder), $uploadedFile->getClientOriginalName());
        /** @var  $name */
        $name = pathinfo($file, PATHINFO_FILENAME);
        if (Image::query()->where('folder', $folder)->where('name', $name)->where('extension', $file->getExtension())->exists()) {
            return redirect(route('images'))->withErrors('Image already exist');
        }
        $image = new Image();
        $image->name = $name;
        $image->folder = $folder;
        $image->width = $sizes[0];
        $image->height = $sizes[1];
        $image->size = $file->getSize();
        $image->extension = $file->getExtension();

        if ($image->save()) {
            return redirect(route('images'));
        }

        unlink($image->path);

        return redirect(route('images'))->withErrors('Could not save image');
    }
}
