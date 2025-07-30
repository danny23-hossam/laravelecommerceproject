<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate and authenticate the user
        $request->authenticate();
        session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // Check if user is authenticated and has a role
        if ($user && isset($user->role)) {
            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('index');
            } elseif ($user->role === 'client' || $user->role === 'user') {
                return redirect()->route('client');
            }
        }

        // Optional: fallback for unknown or missing roles
        Auth::logout();
        return redirect('/login')->withErrors([
            'email' => 'Unauthorized role or authentication failed.',
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
