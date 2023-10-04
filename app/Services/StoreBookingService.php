<?php

namespace App\Services;


use App\Http\Requests\BookingRequest;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Str;
use App\Models\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\DB;

class StoreBookingService
{
    public function storeBooking(BookingRequest $request)
    {
        $booking = Booking::create($request->validated());

        $service = new FileService($booking);
        $service->create($booking);
        return redirect()->route('bookings.index')->with('message', 'Booking created');
    }
}
