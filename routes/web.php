<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('authen.register');
    Route::post('/store', 'store')->name('authen.store');
    Route::get('/login', 'login')->name('authen.login');
    Route::post('/logout', 'logout')->name('authen.logout');
    Route::post('/authenticate', 'authenticate')->name('authen.authenticate');
    Route::get('dashboard', 'dashboard')->name('authen.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});
Route::get('admin/index', [HomeController::class, 'index'])->name('admin.index')->can('admin', Auth::user());

// Flights resource controller
Route::resource('flights', FlightController::class);
//Pages resource controller
Route::resource('pages', PageController::class);

Route::get('bookings/index', [BookingController::class, 'index'])->name('bookings.index')->can('admin', Auth::user());
Route::post('/bookings/restore/{booking}', [BookingController::class, 'restore'])->name('bookings.restore')->can('admin', Auth::user());

/* paypal Routes */
Route::controller(PayPalController::class)->group(function () {
    Route::get('createTransaction/{flight}', 'createTransaction')->name('createTransaction');
    Route::get('process-transaction/{flight}', 'processTransaction')->name('processTransaction');
    Route::get('success-transaction/{flight}', 'successTransaction')->name('successTransaction');
    Route::get('cancel-transaction', 'cancelTransaction')->name('cancelTransaction');
});
