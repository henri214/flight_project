<?php

namespace App\Services;

use App\Models\User;
use App\Models\Media;
use App\Http\Traits\ImageManager;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserRequest;

class UserService
{
    use ImageManager;

    public function storeUser(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $path = storage_path('public');
            !is_dir($path) &&
                mkdir($path, 0777, true);
            $file = $request->file('media');

            if ($file = $request->file('media')) {
                $service = new MediaService($file, $user);
                $service->create($file, $user);
            }
        });
        return redirect()->route('users.index')
            ->with('success', 'You have successfully created a user');
    }
}
