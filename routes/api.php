<?php

use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['api_token'])->group(function () {
    Route::get('flights', [FlightController::class, 'flights']);
    Route::post('flights/booking', [FlightController::class, 'booking']);
    Route::delete('flights/bookings/cancel/{id}', [FlightController::class, 'cancel']);
    Route::get('flights/bookings/find', [FlightController::class, 'find']);
    Route::get('flights/allbookings', [FlightController::class, 'allbookings']);
    Route::get('flights/byflight', [FlightController::class, 'byflight']);

});
