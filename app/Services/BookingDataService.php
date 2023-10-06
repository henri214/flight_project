<?php

namespace App\Services;


use App\Interfaces\DataTableInterface;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Yajra\DataTables\Facades\DataTables;

class BookingDataService implements DataTableInterface
{
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::when(auth()->user()->role_id !== 1, function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->with('flight')->withTrashed()->get();
            return $this->dataTable($data);
        }
        return view('bookings.index');
    }
    public function dataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($booking) {
                if ($booking->deleted_at == null) {
                    return view('components.form.form-action', ['item' => 'booking', 'value' => $booking]);
                } else {
                    return view('components.form.form-restore', ['item' => 'booking', 'value' => $booking]);
                }
            })
            ->addColumn('twoWay', function ($booking) {
                if ($booking->flight->two_way === 1) {
                    return 'Yes';
                } else {
                    return 'No';
                }
            })
            ->addColumn('secondDepartureTime', function ($booking) {
                if ($booking->flight->two_way === 1) {
                    return $booking->flight->two_way_departure_time;
                } else {
                    return '---';
                }
            })
            ->addColumn('secondArrivalTime', function ($booking) {
                if ($booking->flight->two_way === 1) {
                    return $booking->flight->two_way_arrival_time;
                } else {
                    return '---';
                }
            })
            ->rawColumns(['action', 'twoWay', 'secondDepartureTime', 'secondArrivalTime'])
            ->make(true);
    }
}
