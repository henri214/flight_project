<?php

namespace App\Services;

use App\Models\Media;
use App\Http\Traits\ImageManager;

class MediaService
{
    use ImageManager;
    public $file;
    public $user;

    public function __construct($file, $user)
    {
        $this->file = $file;
        $this->user = $user;
    }
    public function create($file, $user)
    {
        $fileData = $this->storeFile($file, 'images');

        Media::create([
            'path' => $fileData['path'],
            'original_name' =>  $fileData['original_name'],
            'hash_name' => $fileData['hash_name'],
            'extension' => $fileData['extension'],
            'size' => $fileData['size'],
            'user_id' => $user->id
        ]);
    }
}
