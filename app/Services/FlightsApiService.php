<?php

namespace App\Services;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\FindBookingApiRequest;

class FlightsApiService
{
    public function cancel(FindBookingApiRequest $request)
    {
        $email = $request->user_email;
        $pageName = $request->page_name;
        $user = User::where('email', '=', $email)->get()->first();
        $booking = $user->bookings()->filter('id')->get();
        $booking->delete();
        $bookings = Booking::filter('userEmail')->filter('pageName')->get();
        return response()->json($bookings);
    }
    public function find(FindBookingApiRequest $request)
    {
        $email = $request->user_email;
        $user = User::where('email', '=', $email)->get()->first();
        $booking = $user->bookings()->filter('userEmail')->filter('pageName')->get();
        return response()->json($booking);
    }
    public function byflight(Request $request)
    {
        $flightId = $request->flight_id;
        $bookings = Booking::byFlight($flightId)->get();
        return response()->json($bookings);
    }
    public function allbookings(Request $request)
    {
        $pageName = $request->page_name;
        $bookings = Booking::filter('pageName')->get();
        return response()->json($bookings);
    }
}
