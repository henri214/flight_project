<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DataTableInterface;
use Yajra\DataTables\Facades\DataTables;

class FlightsDataService implements DataTableInterface
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = Flight::availability()->orderBy('departure_time')->get();
            return $this->dataTable($data);
        }
        return view('flights.index');
    }
    public function dataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('twoWay', function ($flight) {
                if ($flight->two_way === 0) {
                    return "Yes";
                } else {
                    return "No";
                }
            })
            ->addColumn('secondDepartureTime', function ($flight) {
                if ($flight->two_way === 1) {
                    return $flight->two_way_departure_time;
                } else {
                    return '---';
                }
            })
            ->addColumn('secondArrivalTime', function ($flight) {
                if ($flight->two_way === 1) {
                    return $flight->two_way_arrival_time;
                } else {
                    return '---';
                }
            })
            ->addColumn('action', function ($flight) {
                return '<a class="btn btn-primary"
                href="' . route('createTransaction', $flight) . '" role="button">Book</a>';
            })
            ->rawColumns(['action', 'twoWay'])
            ->make(true);
    }
}
