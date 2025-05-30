<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // DashboardController.php

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Vendor')) {
            // Vendor-specific data
            $orders = Order::whereHas('items.inventory', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['items' => function ($query) use ($user) {
                $query->with(['inventory' => function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                }]);
            }])->get();

            $orderStatusCounts = $orders->groupBy('status')->map->count();

            // Calculate vendor's revenue (sum of selling_price * quantity for all items)
            $totalRevenue = 0;
            foreach ($orders as $order) {
                foreach ($order->items as $item) {
                    if ($item->inventory) {
                        $totalRevenue += $item->inventory->selling_price * $item->quantity;
                    }
                }
            }

            return view('dashboard.index', [
                'orderStatusCounts' => $orderStatusCounts,
                'totalRevenue' => $totalRevenue,
                'isVendor' => true
            ]);
        } else {
            // Admin/Manager/CS data
            $orderStatusCounts = Order::groupBy('status')->selectRaw('status, count(*) as count')->pluck('count', 'status');
            $totalOrders = Order::count();
            $totalRevenue = OrderItem::sum('amount');

            return view('dashboard.index', [
                'orderStatusCounts' => $orderStatusCounts,
                'totalOrders' => $totalOrders,
                'totalRevenue' => $totalRevenue,
                'isVendor' => false
            ]);
        }
    }
}
