<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlightRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\OrderProcessed;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $flights = Flight::availability()->orderBy('departure_time')->paginate(10);
        return view('flights.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $airlines = Airline::query()->pluck('name', 'id');
        $availability = collect([1 => 'Yes', 0 => 'No']);
        $two_way = collect([1 => 'Yes', 0 => 'No']);
        return view('flights.create', compact(['airlines', 'availability', 'two_way']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightRequest $request)
    {
        if ($request->user()->cannot('create', 'App\\Models\Flight')) {
            abort(403);
        }
        $flight = Flight::create($request->validated());
        return redirect()->route('admin.index')->with('message', 'Flight created');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        $airlines = Airline::query()->pluck('name', 'id');
        $availability = collect([1 => 'Yes', 0 => 'No']);
        $two_way = collect([1 => 'Yes', 0 => 'No']);
        return view('flights.edit', compact(['flight', 'airlines', 'availability', 'two_way']));
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FlightRequest $request, Flight $flight)
    {
        if ($request->user()->cannot('update', $flight)) {
            abort(403);
        }
        $flight->update($request->validated());
        return redirect()->route('flights.index')->with('message', 'Flight updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        if (auth()->user()->cannot('delete', $flight)) {
            abort(403);
        }
        $flight->deleteOrFail();
        return redirect()->route('flights.index')->with('message', 'Flight deleted');
    }
}
