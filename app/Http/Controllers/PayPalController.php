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
        try {
            return view('transactions.create-transaction', compact('flight'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function processTransaction(Request $request, Flight $flight)
    {
        try {
            return $this->paypalService->processTransaction($request, $flight);
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function successTransaction(Request $request, Flight $flight)
    {
        try {
            return $this->paypalService->successTransaction($request, $flight);
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function cancelTransaction(Request $request)
    {
        try {
            return redirect()
                ->route('createTransaction')
                ->with('error', $this->response['message'] ?? 'You have canceled the transaction.');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }
}
