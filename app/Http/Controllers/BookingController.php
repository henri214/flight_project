<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        if (!Gate::allows('admin', Auth::user())) {
            abort(403);
        } else {
            $bookings = Booking::withTrashed()->get();
            return view('bookings.index', compact('bookings'));
        }
    }
    public function restore($booking, Request $request)
    {
        Booking::withTrashed()->findOrFail($booking)->restore();
        return redirect()->back();
    }
    
    // public function create(Flight $flight)
    // {

    //     return view('bookings.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(BookingRequest $request)
    // {
    //     try {
    //         $stripe = new StripeClient(env('STRIPE_SECRET'));

    //         $stripe->paymentIntents->create([
    //             'amount' => 99 * 100,
    //             'currency' => 'usd',
    //             'payment_method' => $request->payment_method,
    //             'description' => 'Demo payment with stripe',
    //             'confirm' => true,
    //             'receipt_email' => $request->email
    //         ]);
    //     } catch (CardException $th) {
    //         throw new Exception("There was a problem processing your payment", 1);
    //     }

    //     return back()->withSuccess('Payment done.');
    //     $flight = Booking::create($request->validated());
    // }

    /**
     * Display the specified resource.
     */
    // public function show(Booking $booking)
    // {
    //     return view('bookings.show', compact('Booking'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit()
    // {
    // if (!Gate::allows('admin', Auth::user())) {
    //     abort(403);
    // } else {
    //     return view('flights.edit', compact('flight'));
    // }
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request,)
    // {
    // $flight->update($request->validated());
    // $flight->save();
    // return redirect()->route('flights.index')->with('message', 'Flight updated');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        if ((!Auth::user()->id === $booking->user->id)) {
            abort(403);
        } else {
            $booking->deleteOrFail();
            return redirect()->route('booking.index')->with('message', 'Booking deleted');
        }
    }
}
