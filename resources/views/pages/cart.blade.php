@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Your Shopping Cart</h1>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="p-4 text-gray-600 font-semibold">Product</th>
                        <th class="p-4 text-gray-600 font-semibold">Price</th>
                        <th class="p-4 text-gray-600 font-semibold text-center">Quantity</th>
                        <th class="p-4 text-gray-600 font-semibold text-right">Subtotal</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <tr>
                            <td class="p-4 flex items-center">
                                <img src="{{ $details['image'] ?? 'https://via.placeholder.com/100' }}" class="w-16 h-16 object-cover rounded mr-4">
                                <span class="font-medium text-gray-900">{{ $details['name'] }}</span>
                            </td>
                            <td class="p-4 text-gray-600">৳{{ number_format($details['price']) }}</td>
                            <td class="p-4 text-center">
                                <form action="/cart/update" method="POST" class="flex items-center justify-center">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 border rounded p-1 text-center mr-2">
                                    <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm"><i class="fas fa-sync-alt"></i></button>
                                </form>
                            </td>
                            <td class="p-4 text-right font-bold text-gray-900">৳{{ number_format($details['price'] * $details['quantity']) }}</td>
                            <td class="p-4 text-right">
                                <form action="/cart/remove" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex justify-between mb-4 text-lg">
                    <span class="font-semibold text-gray-600">Total:</span>
                    <span class="font-bold text-gray-900 text-2xl">৳{{ number_format($total) }}</span>
                </div>
                <a href="/checkout" class="block w-full text-center bg-amber-600 text-white font-bold py-3 rounded hover:bg-amber-700 transition">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg border border-gray-100">
            <i class="fas fa-shopping-cart text-6xl text-gray-200 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Your cart is empty</h2>
            <a href="{{ route('shop') }}" class="inline-block bg-slate-900 text-white px-6 py-2 rounded hover:bg-slate-800 transition">Return to Shop</a>
        </div>
    @endif
</div>
@endsection