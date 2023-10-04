<?php

namespace App\Services;

use App\Http\Traits\FileManager;
use App\Models\File;

class FileService
{
    public $booking;
    use FileManager;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }
    public function create($booking)
    {
        //storing the file and pdf
        $fileData = $this->storeBookingPdf($booking);
        //creating the file form the data
        File::create([
            'path' => $fileData['path'],
            'original_name' =>  $fileData['original_name'],
            'hash_name' => $fileData['hash_name'],
            'extension' => $fileData['extension'],
            'size' => $fileData['size'],
            'user_id' => $booking->user_id
        ]);
    }
}
