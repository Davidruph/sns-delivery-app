<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the view with the inventory data
        return view('dashboard.inventory.index', compact('inventory'));
    }

    public function view_all_inventory()
    {
        $userIds = Auth::user()->groupUsers->pluck('id');

        $inventory = Inventory::whereIn('user_id', $userIds)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the view with the inventory data
        return view('dashboard.inventory.view_all_inventory', compact('inventory'));
    }

    public function create()
    {
        // Return the view to create a new inventory item
        return view('dashboard.inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('inventories')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
            'category' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0'
        ], [
            'name.unique' => 'Product already exist, update instead.',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename with extension
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Save to public_html/storage/inventory_images
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/inventory_images';

            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded file
            $image->move($destinationPath, $filename);

            // Save relative path to DB
            $validated['image'] = 'inventory_images/' . $filename;
        }

        // Optionally attach the currently logged-in user
        $validated['user_id'] = Auth::user()->id;

        // Save inventory
        Inventory::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Inventory created successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        if (Auth::user()->id != $inventory->user_id) {
            abort(403, 'You are not authorized to delete this inventory item.');
        }

        // Delete associated image if it exists
        if ($inventory->image && Storage::disk('public')->exists($inventory->image)) {
            Storage::disk('public')->delete($inventory->image);
        }

        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Inventory item deleted successfully.');
    }
}
