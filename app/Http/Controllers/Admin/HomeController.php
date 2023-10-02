<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index()
    {
        // if (!Gate::allows('admin', Auth::user())) {
        //     abort(403);
        // } else {
        $flights = Flight::orderBy('departure_time')->paginate(10);
        return view('admin.index', compact('flights'));
        // }
    }
}
