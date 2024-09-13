<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Store the payment in the database
        $payment = Payment::create([
            'account_number' => $request->input('account_number'),
            'amount' => $request->input('amount'),
            'status' => 'pending',
        ]);

        // Call payment API
        $response = Http::post('https://payment-api.com/process', [
            'account_number' => $payment->account_number,
            'amount' => $payment->amount,
        ]);

        if ($response->successful()) {
            $payment->status = 'completed';
            $payment->save();
            return redirect('/payment')->with('success', 'Payment successful!');
        } else {
            return redirect('/payment')->with('error', 'Payment failed!');
        }
    }
}
