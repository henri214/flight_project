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
        $airlines = Airline::all();
        return view('flights.create', compact('airlines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlightRequest $request)
    {
        $flight = Flight::create($request->validated());
        return redirect()->route('admin.index')->with('message', 'Flight created');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        if (!Gate::allows('admin', Auth::user())) {
            abort(403);
        } else {
            $airlines = Airline::all();
            return view('flights.edit', compact(['flight', 'airlines']));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());
        $flight->save();
        return redirect()->route('flights.index')->with('message', 'Flight updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        if (!Gate::allows('admin', Auth::user())) {
            abort(403);
        } else {
            $flight->deleteOrFail();
            return redirect()->route('flights.index')->with('message', 'Flight deleted');
        }
    }
}
