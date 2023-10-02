<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\FindBookingApiRequest;
use App\Services\FlightsApiService;

class FlightController extends Controller
{
    public $flightsApiService;

    public function __construct(FlightsApiService $flightsApiService)
    {
        $this->flightsApiService = $flightsApiService;
    }
    public function flights()
    {
        $flights = Flight::availability()->get();
        return response()->json($flights);
    }
    public function booking(BookingRequest $request)
    {
        $booking = Booking::create($request->validated());
        return response()->json($booking);
    }

    public function cancel($id, FindBookingApiRequest $request)
    {
        return $this->flightsApiService->cancel($request);
    }
    public function find(FindBookingApiRequest $request)
    {
        return $this->flightsApiService->find($request);
    }
    public function byflight(Request $request)
    {
        return $this->flightsApiService->byflight($request);
    }
    public function allbookings(Request $request)
    {
        return $this->flightsApiService->allbookings($request);
    }
}
