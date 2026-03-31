@extends('layouts.app')

@section('content')

<style>
    /* Utility to hide scrollbars for sleek image swiping */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 lg:pt-36 pb-8 sm:pb-12">
    
    <nav class="text-xs sm:text-sm text-gray-500 mb-6 sm:mb-8 flex items-center gap-2 overflow-x-auto whitespace-nowrap hide-scrollbar">
        <a href="{{ route('home') }}" class="hover:text-brand-red transition">Home</a> 
        <i class="fas fa-chevron-right text-[8px] sm:text-[10px]"></i>
        
        @if($product->category && $product->category->parent)
            <a href="{{ route('category.show', $product->category->parent->slug) }}" class="hover:text-brand-red transition">{{ $product->category->parent->name }}</a> 
            <i class="fas fa-chevron-right text-[8px] sm:text-[10px]"></i>
        @endif

        @if($product->category)
            <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-brand-red transition">{{ $product->category->name }}</a> 
            <i class="fas fa-chevron-right text-[8px] sm:text-[10px]"></i>
        @endif
        
        <span class="text-gray-900 font-medium truncate">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 bg-white p-4 sm:p-8 lg:p-10 rounded-2xl shadow-sm border border-gray-100">
        
        <div class="relative w-full rounded-xl overflow-hidden bg-gray-50 border border-gray-100">
            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar w-full aspect-square sm:aspect-[4/5] md:aspect-square lg:aspect-[4/5] scroll-smooth">
                
                <div class="w-full h-full flex-shrink-0 snap-center relative">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x800?text=No+Image' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover">
                </div>
                
                @if(is_array($product->gallery) && count($product->gallery) > 0)
                    @foreach($product->gallery as $image)
                        <div class="w-full h-full flex-shrink-0 snap-center relative">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="{{ $product->name }} Alternate View" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                @endif
            </div>

            @if(is_array($product->gallery) && count($product->gallery) > 0)
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-1.5 bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-full z-10 pointer-events-none">
                <i class="fas fa-arrows-alt-h text-[8px] text-white/80 mr-1"></i>
                <div class="w-1.5 h-1.5 rounded-full bg-white shadow"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-white/50 shadow"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-white/30 shadow"></div>
            </div>
            @endif
            
            @if($product->sale_price)
                <span class="absolute top-4 left-4 bg-red-500 text-white text-xs uppercase font-bold px-3 py-1 z-20 rounded shadow-md">Sale</span>
            @endif
        </div>

        <div class="flex flex-col justify-center">
            @if($product->category)
                <span class="text-xs sm:text-sm font-semibold text-brand-red tracking-wider uppercase mb-2">
                    {{ $product->category->name }}
                </span>
            @endif
            
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-tight">
                {{ $product->name }}
            </h1>
            
            <div class="flex flex-wrap items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                @if($product->sale_price)
                    <span class="text-2xl sm:text-3xl font-bold text-brand-red">৳{{ number_format($product->sale_price, 2) }}</span>
                    <span class="text-lg sm:text-xl text-gray-400 line-through">৳{{ number_format($product->price, 2) }}</span>
                @else
                    <span class="text-2xl sm:text-3xl font-bold text-gray-900">৳{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <div class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8 leading-relaxed prose prose-sm sm:prose-base max-w-none">
                {{ $product->description ?? 'No specific description available for this product. Contact us for detailed material and dimension specifications.' }}
            </div>

            <div class="mb-8 bg-gray-50 p-4 sm:p-5 rounded-lg border border-gray-100 border-l-4 border-l-brand-red">
                <h3 class="text-sm font-bold text-gray-900 mb-1.5 flex items-center gap-2">
                    <i class="fas fa-gem text-brand-red text-xs"></i> The Advance Doors Promise
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Every product we offer is carefully crafted and rigorously tested to ensure the highest standards of quality, aesthetics, and durability. By choosing us, you're investing in an experience designed to make your home feel beautiful and uniquely yours.
                </p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 border-t border-gray-100 pt-6 sm:pt-8">
                @csrf
                <button type="submit" class="flex-1 bg-brand-dark text-white font-bold text-base sm:text-lg py-3.5 sm:py-4 rounded-lg hover:bg-brand-red transition shadow-lg flex justify-center items-center gap-2">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
            </form>
            
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm text-gray-500 border-t border-gray-100 pt-8">
                <p class="flex items-center gap-2"><i class="fas fa-truck text-brand-red"></i> Nationwide Delivery Available</p>
                <p class="flex items-center gap-2"><i class="fas fa-shield-alt text-brand-red"></i> Premium Quality Guaranteed</p>
                <p class="flex items-center gap-2"><i class="fas fa-headset text-brand-red"></i> 24/7 Dedicated Support</p>
                <p class="flex items-center gap-2"><i class="fas fa-lock text-brand-red"></i> Secure Shopping Checkout</p>
            </div>
        </div>
    </div>
</div>
@endsection