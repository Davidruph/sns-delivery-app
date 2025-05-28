<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('group_id', Auth::user()->group_id)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Vendor');
            })
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|exists:roles,name',
            'username' => 'required|string|max:255|unique:users,username,',
            'phone' => 'required|string|max:255|unique:users,phone',
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

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        if ($user->group_id !== Auth::user()->group_id) {
            return redirect()->route('users.index')->with('error', 'Unauthorized access.');
        }
        $user->load('roles');
        $roles = Role::all();

        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->group_id !== $user->group_id) {
            abort(403, 'You are not authorized to delete this user.');
        }

        $user->delete();
        return redirect()->route('vendors.index')->with('success', 'User deleted successfully.');
    }
}
