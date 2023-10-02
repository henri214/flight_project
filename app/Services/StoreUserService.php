<?php

namespace App\Services;

use App\Models\User;
use App\Models\Media;
use App\Http\Traits\ImageManager;
use App\Http\Requests\StoreUserRequest;

class StoreUserService
{
    use ImageManager;

    public function storeUser(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $path = storage_path('public');
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $file = $request->file('media');

        if ($file = $request->file('media')) {
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
        return redirect()->route('users.index')
            ->with('message', 'You have successfully created a user');
    }
}
