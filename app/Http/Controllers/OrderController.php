<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.order.index');
    }

    public function create()
    {
        return view('dashboard.order.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new order
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'address' => $request->address,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }
}
