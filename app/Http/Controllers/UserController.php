<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageManager;
use App\Models\Role;
use App\Models\User;
use App\Models\Media;
use App\Services\StoreUserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Page;

class UserController extends Controller
{

    public function index()
    {
        $users = User::whereNull('role_id')->paginate();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function create()
    {
        $roles = Role::query()->pluck('name', 'id');
        $pages = Page::query()->pluck('name', 'id');
        $genders = collect(['male' => 'Male', 'female' => 'Female']);
        return view('users.create', compact(['roles', 'pages', 'genders']));
    }
    public function store(StoreUserRequest $request)
    {
        $service = new StoreUserService();
        return $service->storeUser($request);
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route('users.index')
            ->with('message', 'You have successfully updated your profile');
    }
    public function destroy(User $user)
    {
        $user->deleteOrFail();
        return redirect()->route('users.index')->with('message', 'User deleted');
    }
}
