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
            'address' => 'required|string|max:255',
            'staff_position' => 'required|string|max:255'
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
            'staff_position' => $request->staff_position,
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
            'address' => 'required|string|max:255',
            'staff_position' => 'required|string|max:255'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'staff_position' => $request->staff_position,
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

    public function signup_request()
    {
        $users = User::where('group_id', '!=', Auth::user()->group_id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.users.signup_request', compact('users'));
    }

    public function signup_request_status(Request $request, User $user)
    {
        $request->validate([
            'user_status' => 'required|in:active,pending,disabled'
        ]);

        // Make sure group_id is present to avoid MySQL error
        if (is_null($user->group_id)) {
            return redirect()->route('users.signup_request')
                ->withErrors(['group_id' => 'User must be assigned to a group before approval.']);
        }

        $user->status = $request->user_status;
        $user->save();

        $messages = [
            'active' => 'User approved and activated successfully.',
            'pending' => 'User status reverted to pending.',
            'disabled' => 'User rejected and disabled successfully.'
        ];

        return redirect()->route('users.signup_request')->with('success', $messages[$request->user_status]);
    }
}
