<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Show checkout form
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        return view('pages.checkout', compact('cart'));
    }

    // Process the order
    public function process(Request $request)
    {
        // 1. Validate customer data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('shop');

        // Calculate Total
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // 2. Save Order to Database (Assuming you create an Order model later)
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

       // 3. Save Order Items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // 4. Clear Cart and Redirect
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully! We will contact you soon.');
    }
}