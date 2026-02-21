@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Billing Details Form -->
        <div class="w-full md:w-2/3">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold mb-6 border-b pb-2">Billing Information</h2>
                
                <form action="/checkout/process" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                            <input type="text" name="first_name" class="w-full border p-2 rounded focus:ring-amber-500 focus:border-amber-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                            <input type="text" name="last_name" class="w-full border p-2 rounded focus:ring-amber-500 focus:border-amber-500" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" class="w-full border p-2 rounded focus:ring-amber-500 focus:border-amber-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                            <input type="text" name="phone" class="w-full border p-2 rounded focus:ring-amber-500 focus:border-amber-500" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Full Address</label>
                        <textarea name="address" rows="3" class="w-full border p-2 rounded focus:ring-amber-500 focus:border-amber-500" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">City</label>
                        <input type="text" name="city" class="w-full border p-2 rounded focus:ring-amber-500 focus:border-amber-500" required>
                    </div>

                    <button type="submit" class="w-full bg-amber-600 text-white font-bold py-4 rounded text-lg hover:bg-amber-700 transition">
                        Place Order
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="w-full md:w-1/3">
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 sticky top-24">
                <h2 class="text-xl font-bold mb-6 border-b pb-2">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    @php $total = 0; @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $details['name'] }} <span class="text-gray-400">x{{ $details['quantity'] }}</span></span>
                                <span class="font-medium">৳{{ number_format($details['price'] * $details['quantity']) }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="border-t border-gray-200 pt-4 flex justify-between items-center text-lg font-bold">
                    <span>Total</span>
                    <span class="text-amber-600 text-2xl">৳{{ number_format($total) }}</span>
                </div>
                
                <p class="text-xs text-gray-500 mt-6 text-center">Cash on delivery available.</p>
            </div>
        </div>
    </div>
</div>
@endsection