<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.inventory')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('dashboard.order.index', compact('orders'));
    }

    public function view_all_orders()
    {
        $userIds = Auth::user()->groupUsers->pluck('id');
        $statuses = $this->getAvailableStatusesForRole();

        $orders = Order::with(['items.inventory', 'user'])
            ->whereIn('user_id', $userIds)
            ->latest()
            ->paginate(10);

        return view('dashboard.order.view_all_orders', compact('orders', 'statuses'));
    }


    public function create()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $products = Inventory::where('user_id', Auth::user()->id)->select('id', 'name')->get();
        return view('dashboard.order.create', compact('user', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product.*' => 'required|exists:inventories,id',
            'quantity.*' => 'required|integer|min:1',
            'amount.*' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            // Loop through products and attach them
            foreach ($request->product as $index => $productId) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'inventory_id' => $productId,
                    'quantity' => $request->quantity[$index],
                    'amount' => $request->amount[$index],
                ]);
            }

            $rolesToNotify = ['Super Admin', 'Portal Manager', 'Customer Service'];
            $superAdmins = User::role($rolesToNotify)
                ->where('group_id', Auth::user()->group_id)
                ->where('id', '!=', Auth::id())
                ->get();

            Notification::sendNow($superAdmins, new NewOrderNotification($order));
            Log::info('Notified users about order #' . $order->id, [
                'users' => $superAdmins->pluck('id')->toArray()
            ]);
        });

        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }

    public function view(Order $order)
    {
        $statuses = $this->getAvailableStatusesForRole();
        $order->load('items.inventory');
        return view('dashboard.order.view', compact('order', 'statuses'));
    }

    public function edit(Order $order)
    {
        if (Auth::user()->id !== $order->user_id) {
            abort(403, 'You are not authorized to edit this order.');
        }

        $products = Inventory::where('user_id', Auth::user()->id)->select('id', 'name')->get();
        $user = $order->user;
        $order->load('items.inventory');
        return view('dashboard.order.edit', compact('order', 'products', 'user'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product' => 'required|array|min:1',
            'product.*' => 'required|exists:inventories,id',
            'quantity.*' => 'required|integer|min:1',
            'amount.*' => 'required|numeric|min:0',
            'address' => 'required|string|max:255'
        ]);

        if (Auth::user()->id !== $order->user_id) {
            abort(403, 'You are not authorized to update this order.');
        }

        $order->update([
            'address' => $request->address,
        ]);

        // Delete removed items
        $existingIds = $order->items->pluck('id')->toArray();
        $submittedIds = $request->item_ids ?? [];
        $toDelete = array_diff($existingIds, $submittedIds);
        OrderItem::destroy($toDelete);

        // Update existing or create new
        if (is_array($request->product)) {
            foreach ($request->product as $index => $productId) {
                $itemId = $request->item_ids[$index] ?? null;
                $data = [
                    'inventory_id' => $productId,
                    'quantity' => $request->quantity[$index],
                    'amount' => $request->amount[$index],
                ];

                if ($itemId) {
                    $order->items()->where('id', $itemId)->update($data);
                } else {
                    $order->items()->create($data);
                }
            }
        }


        return redirect()->route('order.index')->with('success', 'Order updated successfully.');
    }

    private function getAvailableStatusesForRole()
    {
        $role = Auth::user()->getRoleNames()->first();

        switch ($role) {
            case 'Super Admin':
                return ['Pending', 'Paid', 'Delivery Arranged', 'Delivered', 'Wrong number', 'Not available', 'Number not reachable'];

            case 'Portal Manager':
                return ['Pending', 'Paid', 'Delivery Arranged', 'Delivered', 'Wrong number', 'Not available', 'Number not reachable'];

            case 'Customer Service':
                return ['Pending', 'Paid', 'Delivery Arranged', 'Wrong number', 'Not available', 'Number not reachable'];

            default:
                return ['Pending'];
        }
    }

    public function change_order_status(Request $request, Order $order)
    {
        $allowedStatuses = $this->getAvailableStatusesForRole();

        $request->validate([
            'order_status' => ['required', Rule::in($allowedStatuses)],
            'remark' => 'nullable|string|max:1000',
        ]);

        $order->update([
            'status' => $request->order_status,
            'remark' => $request->remark,
        ]);

        // Get the user who owns the order as a collection
        $userToNotify = User::where('id', $order->user_id)->get();

        Notification::sendNow($userToNotify, new NewOrderNotification(
            $order,
            'Order Status Updated',
            "Your order #{$order->id} status has been updated to: {$order->status}",
            route('order.view', $order->id)
        ));

        return back()->with('success', 'Order status updated.');
    }



    public function destroy(Order $order)
    {
        if (Auth::user()->id !== $order->user_id) {
            abort(403, 'You are not authorized to delete this order.');
        }

        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }
}
