<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\DataTableInterface;
use Yajra\DataTables\Facades\DataTables;

class UserDataService implements DataTableInterface
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = User::withTrashed()->get();
            return $this->dataTable($data);
        }
        return view('users.index');
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
                    return view('components.form.form-action', ['item' => 'user', 'value' => $user]);
                } else {
                    return view('components.form.form-restore', ['item' => 'user', 'value' => $user]);
                }
            })
            ->rawColumns(['action', 'role', 'age'])
            ->make(true);
    }
}
