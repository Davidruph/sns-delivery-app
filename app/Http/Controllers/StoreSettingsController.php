<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreSettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $store = Store::where('user_id', $user->id)->first();
        return view('dashboard.store.index', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_currency' => 'required|string|max:100',
            'store_currency_symbol' => 'required|string|max:50',
            'store_phone' => 'required|string|max:255',
            'store_address' => 'required|string|max:255',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $store_logo = null;

        if ($request->hasFile('store_logo')) {
            $image = $request->file('store_logo');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('store_logos', $filename, 'public');
            $store_logo = $imagePath;
        }

        $user = $request->user();

        Store::updateOrCreate(
            ['user_id' => $user->id],
            [
                'group_id' => $user->group_id,
                'store_name' => $request->store_name,
                'store_phone' => $request->store_phone,
                'store_currency' => $request->store_currency,
                'store_currency_symbol' => $request->store_currency_symbol,
                'store_address' => $request->store_address,
                'store_logo' => $store_logo ?? optional($user->store)->store_logo,
            ]
        );

        return redirect()->route('store.index')->with('success', 'Settings updated successfully.');
    }
}
