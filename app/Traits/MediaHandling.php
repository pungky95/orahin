<?php
/**
 *  Copyright (c) 2019. Orahin
 * @author Pungky Kristianto
 * @url https://orahin.id
 * @date 12/15/19, 3:34 PM
 */

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait MediaHandling
{
    /**
     * Upload media
     * @param $file
     * @param $path
     * @param null $width
     * @param null $aspectRatioRezieWidth
     * @param null $quality
     * @return string
     */
    public function upload($file, $path, $width = null, $aspectRatioRezieWidth = null, $quality = null)
    {
        $image = Image::make($file);
        if ($width != null) {
            $image->fit($width);
        }
        if ($aspectRatioRezieWidth) {
            $image->resize($aspectRatioRezieWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $path = $path . $file->hashName();
        if ($quality) {
            Storage::put($path, (string)$image->encode(null, $quality));
        } else {
            Storage::put($path, (string)$image->encode());
        }

        return $path;
    }

    /**
     * remove media
     * @param $filePath
     */
    public function remove($filePath)
    {
        if ($filePath) {
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
    }
}
