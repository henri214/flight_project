<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Airline;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlightRequest;
use App\Services\FlightsDataService;
use Yajra\DataTables\Facades\DataTables;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $service = new FlightsDataService();
        return $service->getAll($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('flights.create');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightRequest $request)
    {
        try {
            if ($request->user()->cannot('create', 'App\\Models\Flight')) {
                abort(403);
            }
            Flight::create($request->validated());
            return redirect()->route('admin.index')->with('success', 'Flight created');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        try {
            $airlines = Airline::query()->pluck('name', 'id');
            $availability = collect([1 => 'Yes', 0 => 'No']);
            $twoWay = collect([1 => 'Yes', 0 => 'No']);
            return view('flights.edit', compact(['flight', 'airlines', 'availability', 'twoWay']));
        } catch (\Throwable $th) {
            return back()->with('error', 'Flight was not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FlightRequest $request, Flight $flight)
    {
        try {
            if ($request->user()->cannot('update', $flight)) {
                abort(403);
            }
            $flight->update($request->validated());
            return redirect()->route('admin.index')->with('success', 'Flight updated');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        try {
            if (auth()->user()->cannot('delete', $flight)) {
                abort(403);
            }
            $flight->deleteOrFail();
            return redirect()->back()->with('success', 'Flight deleted');
        } catch (\Throwable $th) {
            return back()->with('error', 'Flight was not found');
        }
    }
}
