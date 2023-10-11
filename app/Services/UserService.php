<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Traits\ImageManager;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DataTableInterface;
use App\Http\Requests\StoreUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserService implements DataTableInterface
{
    use ImageManager;

    public function getAll(Request $request)
    {

        if ($request->ajax()) {
            $data = User::withTrashed()->get();
            return $this->dataTable($data);
        }
        $roles = Role::pluck('name', 'id');
        $pages = Page::pluck('name', 'id');
        $genders = collect(['male' => 'Male', 'female' => 'Female']);
        return view('users.index', compact(['roles', 'pages', 'genders']));
    }
    public function dataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                if ($user->role_id === 1) {
                    return "Admin";
                } else {
                    return "Guess";
                }
            })
            ->addColumn('age', function ($user) {
                return $user->age;
            })
            ->addColumn('action', function ($user) {
                if ($user->deleted_at == null) {
                    return view('includes.users-actions', ['item' => 'user', 'value' => $user]);
                } else {
                    return view('components.form.form-restore', ['item' => 'user', 'value' => $user]);
                }
            })
            ->editColumn('deleted_at', function ($user) {
                $deleted = $user->deleted_at;
                return $deleted === null ? '---' : $deleted->diffForHumans();
            })
            ->rawColumns(['action', 'role', 'age'])
            ->make(true);
    }

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
