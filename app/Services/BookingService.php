<?php

namespace App\Services;


use App\Models\Page;
use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookingRequest;
use App\Interfaces\DataTableInterface;
use Yajra\DataTables\Facades\DataTables;

class BookingService  implements DataTableInterface
{
    public function storeBooking(BookingRequest $request)
    {
        DB::transaction(function () use ($request) {
            $booking = Booking::create($request->validated());

            $service = new FileService($booking);
            $service->create($booking);
        });
        return redirect()->route('bookings.index')->with('success', 'Booking created');
    }
    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::bookingsOfUser()->get();
            return $this->dataTable($data);
        }
        $flights = Flight::availability()->pluck('name', 'id');
        $pages = Page::pluck('name', 'id');
        $users = User::pluck('username', 'id');
        return view('bookings.index', compact(['flights', 'pages', 'users']));
    }
    public function dataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($booking) {
                if ($booking->deleted_at == null) {
                    return view('includes.bookings-actions', ['item' => 'booking', 'value' => $booking]);
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
            ->editColumn('deleted_at', function ($booking) {
                $deleted = $booking->deleted_at;
                return $deleted === null ? '---' : $deleted->diffForHumans();
            })
            ->rawColumns(['action', 'twoWay', 'secondDepartureTime', 'secondArrivalTime'])
            ->make(true);
    }
}
