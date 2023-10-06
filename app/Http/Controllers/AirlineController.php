<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use App\Http\Requests\AirlineRequest;
use App\Services\AirlineService;


class AirlineController extends Controller
{
    public function index(Request $request)
    {
        $service = new AirlineService();
        return $service->getAll($request);
    }
    public function create()
    {
        return view('admin.airlines.create');
    }
    public function store(AirlineRequest $request)
    {
        Airline::create($request->validated());
        return redirect()->route('airlines.index')->with('success', 'Airline created');
    }
    public function show(Airline $airline)
    {
        return view('admin.airlines.show', compact('airline'));
    }
    public function edit(Airline $airline)
    {
        return view('admin.airlines.edit', compact('airline'));
    }
    public function update(Airline $airline, AirlineRequest $request)
    {
        $airline->update($request->validated());
        return redirect()->route('airlines.index')->with('success', 'Airline updated');
    }
    public function destroy(Airline $airline)
    {
        $airline->delete();
        return redirect()->route('airlines.index')->with('success', 'Airline deleted');
    }
    public function restore($airline)
    {
        Airline::withTrashed()->findOrFail($airline)->restore();
        return redirect()->back()->with('success', 'Airline restored');
    }
}
