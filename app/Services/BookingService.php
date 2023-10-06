<?php

namespace App\Services;


use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookingRequest;

class BookingService
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
}
