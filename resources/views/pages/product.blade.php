@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-amber-600">Home</a> &gt; 
        <a href="{{ route('shop') }}" class="hover:text-amber-600">Shop</a> &gt; 
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <!-- Product Image -->
        <div>
            <img src="{{ $product->image ?? 'https://via.placeholder.com/600x800?text=No+Image' }}" alt="{{ $product->name }}" class="w-full rounded-lg object-cover">
        </div>

        <!-- Product Info -->
        <div class="flex flex-col justify-center">
            @if($product->category)
                <span class="text-sm font-semibold text-amber-600 tracking-wider uppercase mb-2">{{ $product->category->name }}</span>
            @endif
            
            <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $product->name }}</h1>
            
            <div class="flex items-center mb-6">
                <span class="text-3xl font-bold text-gray-900">৳{{ number_format($product->active_price) }}</span>
                @if($product->sale_price)
                    <span class="text-xl text-gray-400 line-through ml-4">৳{{ number_format($product->price) }}</span>
                    <span class="ml-4 bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded">SALE</span>
                @endif
            </div>

            <p class="text-gray-600 mb-8 leading-relaxed">
                {{ $product->description ?? 'No description available for this product.' }}
            </p>

            <form action="/cart/add/{{ $product->id }}" method="POST" class="flex items-center gap-4 border-t border-gray-100 pt-8">
                @csrf
                <button type="submit" class="flex-1 bg-amber-600 text-white font-bold text-lg py-4 rounded hover:bg-amber-700 transition shadow-md">
                    Add to Cart <i class="fas fa-shopping-cart ml-2"></i>
                </button>
            </form>
            
            <div class="mt-8 text-sm text-gray-500 space-y-2 border-t border-gray-100 pt-6">
                <p><i class="fas fa-truck mr-2"></i> Standard Delivery: 3-5 Business Days</p>
                <p><i class="fas fa-shield-alt mr-2"></i> 1 Year Warranty</p>
            </div>
        </div>
    </div>
</div>
@endsection