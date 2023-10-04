<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Media;
use App\Exports\UsersExport;
use App\Services\UserService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::whereNull('role_id')->paginate();
            return view('users.index', compact('users'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function export()
    {
        try {
            return Excel::download(new UsersExport, 'users.xlsx');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function show(User $user)
    {
        try {
            return view('users.show', compact('user'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function create()
    {
        try {
            $roles = Role::pluck('name', 'id');
            $pages = Page::pluck('name', 'id');
            $genders = collect(['male' => 'Male', 'female' => 'Female']);
            return view('users.create', compact(['roles', 'pages', 'genders']));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function store(StoreUserRequest $request)
    {
        try {
            $service = new UserService();
            return $service->storeUser($request);
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function edit(User $user)
    {
        try {
            $roles = Role::pluck('name', 'id');
            $pages = Page::pluck('name', 'id');
            $genders = collect(['male' => 'Male', 'female' => 'Female']);
            return view('users.edit', compact(['roles', 'pages', 'genders', 'user']));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());
            return redirect()->route('users.index')
                ->with('message', 'You have successfully updated your profile');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function destroy(User $user)
    {
        try {
            $user->deleteOrFail();
            return redirect()->route('users.index')->with('message', 'User deleted');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
