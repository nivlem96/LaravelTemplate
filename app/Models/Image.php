<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $folder
 * @property string $name
 * @property string $extension
 * @property int $height
 * @property int $width
 * @property int $size
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Image|null $parent
 * @property-read Image[]|Collection $children
 *
 * @property-read string $path
 */
class Image extends Model
{
    use HasPermissions {
        getRolePermissions as public traitRolePermissions;
    }

    public static function getRolePermissions(): array
    {
        return array_merge(self::traitRolePermissions(),
            [
                Permission::KEY_ACCESS => [Role::ROLE_ADMIN],
                Permission::KEY_UPDATE => [Role::ROLE_ADMIN],
                Permission::KEY_DELETE => [Role::ROLE_ADMIN],
            ]
        );
    }

    public static function getResizedImage(string $originalPath, int $width, int $height): ?string
    {
        if (!file_exists($originalPath)) {
            return null;
        }
        $image = self::getImageFromPath($originalPath);
        /** @var Image $resizedImage */
        $resizedImage = $image->getChildWithDimentions($width, $height) ?? $image->resizeImage($width, $height);

        return $resizedImage?->path;
    }

    public static function getImageFromPath($path): ?Model
    {
        $pathInfo = pathinfo($path);

        return Image::query()->where('folder', $pathInfo['dirname'])->where('name', $pathInfo['filename'])->where('extension', $pathInfo['extension'])->first();
    }

    public function getChildWithDimentions(int $w, int $h): ?Model
    {
        return $this->children()->where('width', $w)->where('height', $h)->first();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Image::class, 'parent_id');
    }

    public function resizeImage(int $w, int $h): Image
    {
        $resizedImage = new Image();
        $resizedImage->parent_id = $this->id;
        $resizedImage->folder = $this->folder;
        $resizedImage->name = $this->name . '_' . $w . 'x' . $h;
        $resizedImage->extension = $this->extension;
        $resizedImage->height = $h;
        $resizedImage->width = $w;
        $img = \Intervention\Image\Facades\Image::make($this->path);
        $img->resize($w, $h, function ($constraint) {
            $constraint->aspectRatio();
        })->save($resizedImage->path);

        $resizedImage->size = filesize($resizedImage->path);
        $resizedImage->saveOrFail();

        return $resizedImage;
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'parent_id');
    }

    public function getPathAttribute()
    {
        return $this->folder . DIRECTORY_SEPARATOR . $this->name . '.' . $this->extension;
    }
}
