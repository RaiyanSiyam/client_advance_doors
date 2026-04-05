<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAddress;

class ProfileController extends Controller
{
    public function index()
    {
        // Eager load addresses to prevent N+1 queries
        $user = Auth::user()->load('addresses');
        return view('pages.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
        ]);

        $user->update($request->only('name', 'email', 'phone'));

        return back()->with('success', 'Personal information updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Security password updated successfully.');
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:500',
        ]);

        Auth::user()->addresses()->create($request->only('city', 'address'));

        return back()->with('success', 'New address added to your address book.');
    }

    public function destroyAddress(UserAddress $address)
    {
        // Security Check: Make sure the user actually owns this address
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $address->delete();

        return back()->with('success', 'Address removed from your account.');
    }
}