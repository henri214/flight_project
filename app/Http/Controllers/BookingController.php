<?php

namespace App\Http\Controllers;


use App\Models\Page;
use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $service = new BookingService();
        return $service->getAll($request);
    }
    public function restore($booking)
    {
        try {
            Booking::withTrashed()->find($booking)->restore();
            return redirect()->back()->with('success', 'Booking restored');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    public function create()
    {
        try {
            $flights = Flight::availability()->pluck('name', 'id');
            $pages = Page::pluck('name', 'id');
            $users = User::pluck('username', 'id');
            return view('bookings.create', compact(['flights', 'pages', 'users']));
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        try {
            $service = new BookingService();
            return $service->storeBooking($request);
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        try {
            return view('bookings.show', compact('Booking'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Booking was not found ');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        try {
            $flights = Flight::availability()->pluck('name', 'id');
            $pages = Page::pluck('name', 'id');
            $users = User::pluck('username', 'id');
            return view('bookings.edit', compact(['flights', 'pages', 'users', 'booking']));
        } catch (\Throwable $th) {
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        try {
            $booking->update($request->validated());
            return redirect()->back()->with('success', 'Booking updated');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'Data inserted incorrectly');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        try {
            if ((!Auth::user()->id === $booking->user->id)) {
                abort(403);
            } else {
                $booking->delete();
                return redirect()->route('bookings.index')->with('success', 'Booking deleted');
            }
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function forceDelete(Booking $booking)
    {
        try {
            if ((!Auth::user()->role_id === 1)) {
                abort(403);
            } else {
                $booking->forceDelete();
                return redirect()->route('bookings.index')->with('success', 'Booking deleted permanently');
            }
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
