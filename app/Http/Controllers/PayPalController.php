<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Notifications\OrderProcessed;
use App\Services\PaypalService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{
    protected $response;
    public $paypalService;

    public function __construct(PaypalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    public function createTransaction(Flight $flight)
    {
        return view('transactions.create-transaction', compact('flight'));
    }
    
    public function processTransaction(Request $request, Flight $flight)
    {
        return $this->paypalService->processTransaction($request, $flight);
    }

    public function successTransaction(Request $request, Flight $flight)
    {
        return $this->paypalService->successTransaction($request, $flight);
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $this->response['message'] ?? 'You have canceled the transaction.');
    }
}
