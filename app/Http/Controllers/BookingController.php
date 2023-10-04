<?php

namespace App\Http\Controllers;


use App\Models\File;
use App\Models\Page;
use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\FileService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BookingRequest;
use App\Services\StoreBookingService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File as FacadesFile;

class BookingController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Booking::class);
        $bookings = Booking::when(auth()->user()->role_id !== 1, function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        })->withTrashed()->paginate();
        return view('bookings.index', compact('bookings'));
    }
    public function restore($booking, Request $request)
    {
        Booking::withTrashed()->findOrFail($booking)->restore();
        return redirect()->back()->with('message', 'Booking restored');
    }

    public function create()
    {
        $flights = Flight::availability()->pluck('name', 'id');
        $pages = Page::pluck('name', 'id');
        $users = User::pluck('username', 'id');

        return view('bookings.create', compact(['flights', 'pages', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {

        $service = new StoreBookingService();
        return $service->storeBooking($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('Booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $flights = Flight::availability()->pluck('name', 'id');
        $pages = Page::pluck('name', 'id');
        $users = User::pluck('username', 'id');
        return view('bookings.edit', compact(['flights', 'pages', 'users', 'booking']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());
        return redirect()->route('bookings.index')->with('message', 'Booking updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        if ((!Auth::user()->id === $booking->user->id)) {
            abort(403);
        } else {
            $booking->delete();
            return redirect()->route('bookings.index')->with('message', 'Booking deleted');
        }
    }
    public function forceDelete(Booking $booking)
    {
        if ((!Auth::user()->role_id === 1)) {
            abort(403);
        } else {
            $booking->forceDelete();
            return redirect()->route('bookings.index')->with('message', 'Booking deleted permanently');
        }
    }
}
