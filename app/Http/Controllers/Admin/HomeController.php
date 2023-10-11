<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flight;
use App\Models\Airline;
use App\Services\FlightsDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    private $adminUserService;

    //construct

    public function index(Request $request)
    {
        $service = new FlightsDataService();
        return $service->getAllFlightsAdmin($request);
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
