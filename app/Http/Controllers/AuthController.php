<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'group_id' => random_int(100000, 999999),
            'plan' => 'free',
            'status' => 'pending',
        ]);

        $user->assignRole('Super Admin');

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }

    /**
     * Display the login view.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [$loginType => $request->input('login'), 'password' => $request->input('password')];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => __('auth.failed'),
            ])->withInput($request->only('login'));
        }

        // Check user status
        $user = Auth::user();

        if ($user->status === 'pending') {
            Auth::logout();
            return back()->withErrors([
                'login' => 'Your account is pending approval. Please contact support.',
            ])->withInput($request->only('login'));
        }

        if ($user->status === 'disabled') {
            Auth::logout();
            return back()->withErrors([
                'login' => 'Your account has been disabled. Please contact support.',
            ])->withInput($request->only('login'));
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function socket_authenticate(Request $request)
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true
            ]
        );


        $auth = $pusher->authorizeChannel($request->channel_name, $request->socket_id);

        return response($auth);
    }
}
