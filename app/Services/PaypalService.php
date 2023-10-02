<?php

namespace App\Services;

use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Notifications\OrderProcessed;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalService
{
    public function processTransaction(Request $request, Flight $flight)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction', $flight),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $flight->price
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.2');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    public function successTransaction(Request $request, Flight $flight)
    {
        $user = $request->user();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $user->notify(new OrderProcessed($flight, $user));
            $booking = new Booking();
            $booking->user_id = auth()->user()->id;
            $booking->flight_id = $flight->id;
            $booking->save();
            return redirect()
                ->route('flights.index')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
