<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Services\UserService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $service = new UserService();
        return $service->getAll($request);
    }
    public function export()
    {
        try {
            return Excel::download(new UsersExport, 'users.xlsx');
        } catch (\Throwable $th) {
            return back()->with('error', 'Exporting into Excel did not work');
        }
    }
    public function show(User $user)
    {
        try {
            return view('users.show', compact('user'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
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
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    public function store(StoreUserRequest $request)
    {
        try {
            $service = new UserService();
            return $service->storeUser($request);
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
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
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());
            return redirect()->route('users.index')
                ->with('success', 'You have successfully updated your profile');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    public function destroy(User $user)
    {
        try {
            $user->deleteOrFail();
            return redirect()->route('users.index')->with('success', 'User deleted');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    public function restore($user)
    {
        User::withTrashed()->findOrFail($user)->restore();
        return redirect()->back()->with('success', 'User restored');
    }
}
