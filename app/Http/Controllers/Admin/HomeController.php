<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flight;
use App\Services\AdminUserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $service = new AdminUserService();
        return $service->getAll($request);
    }
    public function restore($flight)
    {
        try {
            Flight::withTrashed()->find($flight)->restore();
            return redirect()->back()->with('message', 'Flight restored');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
