<?php

namespace App\Http\Controllers;


use App\Models\Page;
use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\Builder;

class BookingController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('viewAny', Booking::class);
            $bookings = Booking::when(auth()->user()->role_id !== 1, function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->withTrashed()->paginate();
            return view('bookings.index', compact('bookings'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
    public function restore($booking)
    {
        try {
            Booking::withTrashed()->findOrFail($booking)->restore();
            return redirect()->back()->with('message', 'Booking restored');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
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
            return back()->withError($th->getMessage())->withInput();
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
            return back()->withError($th->getMessage())->withInput();
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
            return back()->withError($th->getMessage())->withInput();
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
            return back()->withError($th->getMessage())->withInput();
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        try {
            Booking::withTrashed()->findOrFail($booking)->restore();
            return redirect()->back()->with('message', 'Booking restored');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
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
                return redirect()->route('bookings.index')->with('message', 'Booking deleted');
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
                return redirect()->route('bookings.index')->with('message', 'Booking deleted permanently');
            }
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
