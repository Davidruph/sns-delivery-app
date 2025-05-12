<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
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
        $user = User::where('id', Auth::user()->id)->first();
        return view('dashboard.order.create', compact('user'));
    }

    public function store(Request $request)
    {
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

        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }
}
