<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;


trait FileManager
{
    public function storeBookingPdf($booking)
    {
        $data = $this->pdfData($booking);

        $path = storage_path('app\public');
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $pdf = PDF::loadView('bookings.booking', $data);
        $dateTime = now();
        $extension = 'pdf';
        $original_name = $dateTime->format('YmdHis') . '_booking';
        $fileName = $original_name . '.' . $extension;
        $directory = 'files';
        $path2 = '/' . $directory . '/' . $fileName;
        $pdf->save($path . $path2);
        return $pdf = [
            'path' => $directory,
            'original_name' => $original_name,
            'hash_name' => Str::random(20),
            'extension' => $extension,
            'size' => $this->size(File::size($path . $path2)),
        ];
    }
    public function size($nr, $precision = 2)
    {
        if ($nr > 0) {
            $nr = (int) $nr;
            $base = log($nr) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $nr;
    }
    public function pdfData($booking)
    {
        $data = [
            'username' => $booking->user->username,
            'flight_name' => $booking->flight->name,
            'user_mail' => $booking->user->email,
            'departure_time' => $booking->flight->departure_time,
            'arrival_time' => $booking->flight->arrival_time,
            'price' => $booking->flight->price,
        ];

        return $data;
    }
}
