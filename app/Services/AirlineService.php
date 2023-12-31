<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DataTableInterface;
use Yajra\DataTables\Facades\DataTables;

class AirlineService implements DataTableInterface
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = Airline::with('flights')->withTrashed()->latest()->get();
            return $this->dataTable($data);
        }

        return view('admin.airlines.index');
    }
    public function dataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('flightsNr', function ($airline) {
                return $airline->flights->count();
            })
            ->addColumn('action', function ($airline) {
                if ($airline->deleted_at == null) {
                    return view('includes.airlines-actions', ['item' => 'airline', 'value' => $airline]);
                } else {
                    return view('components.form.form-restore', ['item' => 'airline', 'value' => $airline]);
                }
            })
            ->editColumn('deleted_at', function ($airline) {
                $deleted = $airline->deleted_at;
                return $deleted === null ? '---' : $deleted->diffForHumans();
            })
            ->rawColumns(['action', 'flightsNr'])
            ->make(true);
    }
}
