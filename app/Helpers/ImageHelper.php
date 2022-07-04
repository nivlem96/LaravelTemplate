<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getResizedImage(string $originalPath, int $width, string $height): ?string
    {
        if (!file_exists($originalPath)) {
            return null;
        }
        $pathInfo = pathinfo($originalPath);
        $resizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-' . (string)$width . 'x' . (string)$height . '.' . $pathInfo['extension'];

        if (file_exists($resizedPath)) {
            return $resizedPath;
        }

        self::resizeImage($originalPath, $resizedPath, $width, $height);

        return $resizedPath;
    }

    public static function resizeImage(string $originalPath, string $newPath, int $w, int $h, bool $crop = false): bool
    {
        [$width, $height] = getimagesize($originalPath);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($originalPath);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresized($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagejpeg($dst, $newPath, 100);
        $exif = exif_read_data($originalPath);
        if ($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if ($orientation != 1) {
                $img = imagecreatefromjpeg($newPath);
                $deg = 0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                if ($deg) {
                    $img = imagerotate($img, $deg, 0);
                }
                imagejpeg($img, $newPath, 100);
            }
        }

        return $newPath;
    }
}
