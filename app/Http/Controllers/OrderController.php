<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rice;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('rice')->latest()->get();
        $rices = Rice::all();
        return view('order.index', compact('orders', 'rices'));
    }

    public function create()
    {
        $rices = Rice::where('quantity', '>', 0)->get();
        return view('orders.create', compact('rices'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'rice_id' => 'required|exists:rice,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $rice = Rice::findOrFail($request->rice_id);
        $total_cost = $rice->price * $request->quantity;

        if($rice->stock<$request->quantity) {
            return back()->with('error', 'Not enough stock.');
        }

      

        Order::create([
            'rice_id' => $request->rice_id,
            'quantity' => $request->quantity,
            'total_cost' => $total_cost,
            'status' => 'Unpaid'
        ]);

        $rice->decrement('stock', $request->quantity);

        return redirect()->route('dashboard')->with('success', 'Order added successfully.');
    }


    
}
