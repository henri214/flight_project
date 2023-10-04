<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait ImageManager
{
    public function storeFile(UploadedFile $image, $path)
    {
        if ($image) {
            $path2 = $image->store($path);

            return $image = [
                'original_name' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $image->extension(),
                'hash_name' => pathinfo($path2, PATHINFO_FILENAME),
                'path' => $path,
                'size' => $this->size($image)
            ];
        }
    }
    public function size($file, $precision = 2)
    {
        $size = $file->getSize();
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}
