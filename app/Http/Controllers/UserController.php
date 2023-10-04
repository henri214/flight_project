<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Media;
use App\Exports\UsersExport;
use App\Services\StoreUserService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function index()
    {
        $users = User::whereNull('role_id')->paginate();
        return view('users.index', compact('users'));
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $pages = Page::pluck('name', 'id');
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
        $roles = Role::pluck('name', 'id');
        $pages = Page::pluck('name', 'id');
        $genders = collect(['male' => 'Male', 'female' => 'Female']);
        return view('users.edit', compact(['roles', 'pages', 'genders', 'user']));
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
