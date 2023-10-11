<?php

namespace App\Services;

use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Http\Request;
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
    public function getAllFlightsAdmin(Request $request)
    {
        if ($request->ajax()) {
            $data = Flight::availability()->orderBy('departure_time')->withTrashed()->get();
            return $this->dataTableAdmin($data);
        }
        $airlines = Airline::query()->pluck('name', 'id');
        $availability = collect([1 => 'Yes', 0 => 'No']);
        $twoWay = collect([1 => 'Yes', 0 => 'No']);
        return view('admin.index', compact(['airlines', 'availability', 'twoWay']));
    }

    public function dataTableAdmin($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($flight) {
                if ($flight->deleted_at == null) {
                    return view('includes.flights-actions', ['item' => 'flight', 'value' => $flight]);
                } else {
                    return view('components.form.form-restore', ['item' => 'flight', 'value' => $flight]);
                }
            })
            ->addColumn('twoWay', function ($flight) {
                if ($flight->two_way === 0) {
                    return "No";
                } else {
                    return "Yes";
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

            ->editColumn('deleted_at', function ($flight) {
                $deleted = $flight->deleted_at;
                return $deleted === null ? '---' : $deleted->diffForHumans();
            })
            ->rawColumns([
                'action', 'twoWay', 'secondDepartureTime', 'secondArrivalTime'
            ])
            ->make(true);
    }
}
