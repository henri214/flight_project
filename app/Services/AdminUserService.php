<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Interfaces\DataTableInterface;
use Yajra\DataTables\Facades\DataTables;

class AdminUserService implements DataTableInterface
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = Flight::availability()->orderBy('departure_time')->withTrashed()->get();
            return $this->dataTable($data);
        }
        return view('admin.index');
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
                if ($flight->deleted_at == null) {
                    return view('components.form.form-action', ['item' => 'flight', 'value' => $flight]);
                } else {
                    return view('components.form.form-restore', ['item' => 'flight', 'value' => $flight]);
                }
            })
            ->rawColumns([
                'action', 'twoWay', 'secondDepartureTime', 'secondArrivalTime'
            ])
            ->make(true);
    }
}
