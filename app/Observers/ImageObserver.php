<?php

namespace App\Observers;

use App\Models\Image;

class ImageObserver
{
    public function deleting(Image $image)
    {
        foreach ($image->children as $child) {
            $child->delete();
        }
        unlink($image->path);
    }
}
