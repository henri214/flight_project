<?php 
namespace App\Services;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\FindBookingApiRequest;

class FlightsApiService{
    public function cancel(FindBookingApiRequest $request)
    {
        $email = $request->user_email; 
        $page_name = $request->page_name; 
        $user = User::where('email', '=', $email)->get()->first();
        $booking = $user->bookings()->filter('id')->get();
        $booking->delete();
        $bookings = Booking::filter('user_email')->filter('page_name')->get();
        return response()->json($bookings);
    }
    public function find(FindBookingApiRequest $request){
        $email = $request->user_email;
        $user = User::where('email', '=', $email)->get()->first();
        $booking = $user->bookings()->filter('user_email')->filter('page_name')->get();
        return response()->json($booking);
    }
    public function byflight(Request $request)  {
        $flight_id = $request->flight_id;
        $bookings = Booking::byFlight($flight_id)->get();
        return response()->json($bookings);
    }
    public function allbookings(Request $request)
    {
        $page_name = $request->page_name;
        $bookings = Booking::filter('page_name')->get();
        return response()->json($bookings);
    }
}