<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PaymentController extends Controller
{
    public function index() {
        $payments = Payment::with('order.rice')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    public function store(Request $request, Order $order){

        if($order-> status === 'Paid'){
            return back()->with('error', 'This order has already been paid.');
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $request->amount,
        ]);

        $order->update(['status' => 'Paid']);

        return redirect()->route('dashboard')->with('success', 'Payment processed successfully.');
    }

}
