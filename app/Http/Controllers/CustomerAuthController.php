<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Send admins to the backend, regular users stay on the page
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            
            // Stay on the same page instead of redirecting to profile!
            return back()->with('success', 'Welcome back!');
        }

        // Return with a specific error bag key so we know to open the Login tab
        return back()->withErrors([
            'login_error' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        Auth::login($user);

        // Stay on the same page instead of redirecting to profile!
        return back()->with('success', 'Account created successfully! Welcome to Advance Doors.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'You have been logged out securely.');
    }
}