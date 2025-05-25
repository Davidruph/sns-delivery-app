<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('dashboard.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'username' => 'required|string|max:255|unique:users,username,' . $request->user()->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');

            // Generate a unique filename with extension
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Save to public_html/storage/avatar_images
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/avatar_images';

            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded file
            $image->move($destinationPath, $filename);

            // Save relative path to DB
            $user->avatar = 'avatar_images/' . $filename;
        }

        $user->update($request->only('name', 'email', 'username', 'phone', 'address'));

        if ($request->hasFile('avatar')) {
            $user->save(); // Save after setting avatar
        }

        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Profile updated successfully. Please log in again.');
    }

    public function changePassword()
    {
        return view('dashboard.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $request->user()->update(['password' => Hash::make($request->password)]);

        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password changed successfully. Please log in again.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return redirect()->route('login')->with('success', 'Account deleted successfully.');
    }
}
