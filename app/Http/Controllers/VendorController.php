<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('group_id', Auth::user()->group_id)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Vendor');
            })
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.vendors.index', compact('vendors'));
    }


    public function create()
    {
        return view('dashboard.vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'username' => 'required|string|max:255|unique:users,username,',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => Auth::user()->group_id,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'plan' => 'free',
        ]);

        $user->assignRole('Vendor');

        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    public function edit(User $user)
    {
        if ($user->group_id !== Auth::user()->group_id) {
            return redirect()->route('vendors.index')->with('error', 'Unauthorized access.');
        }
        $user->load('roles');
        return view('dashboard.vendors.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);

        if ($user->group_id !== Auth::user()->group_id) {
            return redirect()->route('vendors.index')->with('error', 'Unauthorized access.');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->group_id !== $user->group_id) {
            abort(403, 'You are not authorized to delete this user.');
        }

        $user->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }
}
