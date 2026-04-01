@extends('layouts.app')

@section('content')

<style>
    /* Hide scrollbar for thumbnails */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* Remove arrows from number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 lg:pt-32 pb-12 sm:pb-16">
    
    <!-- Breadcrumb -->
    <nav class="text-[11px] sm:text-xs text-gray-500 mb-4 sm:mb-6 flex items-center gap-1.5 overflow-x-auto whitespace-nowrap hide-scrollbar">
        <a href="{{ route('home') }}" class="hover:text-brand-red transition">Home</a> 
        <i class="fas fa-chevron-right text-[8px] text-gray-400"></i>
        
        @if($product->category && $product->category->parent)
            <a href="{{ route('category.show', $product->category->parent->slug) }}" class="hover:text-brand-red transition">{{ $product->category->parent->name }}</a> 
            <i class="fas fa-chevron-right text-[8px] text-gray-400"></i>
        @endif

        @if($product->category)
            <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-brand-red transition">{{ $product->category->name }}</a> 
            <i class="fas fa-chevron-right text-[8px] text-gray-400"></i>
        @endif
        
        <span class="text-gray-800 font-medium truncate">{{ $product->name }}</span>
    </nav>

    <!-- Main Product Layout (Top Section) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            
            <!-- LEFT SIDE: Image Gallery -->
            <div class="p-4 sm:p-6 lg:p-8 border-b md:border-b-0 md:border-r border-gray-100">
                
                @php
                    $mainImage = $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                @endphp

                <!-- Main Large Image -->
                <div class="aspect-square sm:aspect-[4/5] md:aspect-square rounded-lg overflow-hidden bg-gray-50 border border-gray-100 mb-3 relative">
                    <!-- Sale Badge -->
                    @if($product->sale_price)
                        <span class="absolute top-3 left-3 bg-red-500 text-white text-[10px] sm:text-xs uppercase font-bold px-2.5 py-1 z-10 rounded shadow-sm">Sale</span>
                    @endif
                    
                    <img id="mainImage" src="{{ $mainImage }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                
                <!-- Thumbnails Row -->
                <div class="flex gap-2 overflow-x-auto hide-scrollbar py-1">
                    <!-- Main image as first thumbnail -->
                    <img src="{{ $mainImage }}" onclick="changeImage(this.src, this)" class="thumbnail flex-shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded border-2 border-brand-red object-cover cursor-pointer transition">
                    
                    <!-- Additional Gallery Images -->
                    @if(is_array($product->gallery) && count($product->gallery) > 0)
                        @foreach($product->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}" onclick="changeImage(this.src, this)" class="thumbnail flex-shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded border-2 border-transparent hover:border-brand-red/50 object-cover cursor-pointer transition">
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- RIGHT SIDE: Product Details & Actions -->
            <div class="p-4 sm:p-6 lg:p-8 flex flex-col justify-center">
                
                <!-- Category Tag -->
                @if($product->category)
                    <a href="{{ route('category.show', $product->category->slug) }}" class="text-[10px] sm:text-xs font-bold text-brand-red tracking-wider uppercase mb-1 hover:underline">
                        {{ $product->category->name }}
                    </a>
                @endif
                
                <!-- Title -->
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $product->name }}
                </h1>
                
                <!-- Price Block (Highlighted Background) -->
                <div class="bg-gray-50/80 border border-gray-100 p-4 rounded-lg mb-6">
                    @if($product->sale_price)
                        <div class="flex flex-col sm:flex-row sm:items-end gap-1 sm:gap-3">
                            <span class="text-2xl sm:text-3xl font-extrabold text-brand-red">৳{{ number_format($product->sale_price, 2) }}</span>
                            <span class="text-sm sm:text-base text-gray-400 line-through mb-1">৳{{ number_format($product->price, 2) }}</span>
                        </div>
                    @else
                        <span class="text-2xl sm:text-3xl font-extrabold text-brand-red">৳{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <!-- Short Unified Description -->
                <p class="text-[13px] sm:text-sm text-gray-600 mb-6 leading-relaxed">
                    Premium quality craftsmanship designed to elevate your living spaces. Manufactured with high-grade materials to ensure maximum durability, stunning aesthetics, and a perfect finish for your home.
                </p>

                <hr class="border-gray-100 mb-6">

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    
                    <!-- Quantity Selector -->
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-sm font-medium text-gray-700">Quantity</span>
                        <div class="flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                            <button type="button" onclick="decQty()" class="px-3 sm:px-4 py-1.5 bg-gray-50 hover:bg-gray-200 text-gray-600 font-bold transition focus:outline-none">-</button>
                            <input type="number" name="quantity" id="qty" value="1" min="1" class="w-12 text-center py-1.5 border-none focus:ring-0 text-sm font-medium text-gray-800 bg-white">
                            <button type="button" onclick="incQty()" class="px-3 sm:px-4 py-1.5 bg-gray-50 hover:bg-gray-200 text-gray-600 font-bold transition focus:outline-none">+</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="flex-1 bg-[#F57224] hover:bg-[#d0611e] text-white font-bold py-3 sm:py-3.5 rounded-md transition shadow-md text-sm sm:text-base">
                            Buy Now
                        </button>
                        <button type="submit" class="flex-1 bg-brand-red hover:bg-red-800 text-white font-bold py-3 sm:py-3.5 rounded-md transition shadow-md flex justify-center items-center gap-2 text-sm sm:text-base">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </form>

                <!-- Trust Features -->
                <div class="mt-8 pt-6 border-t border-gray-100 grid grid-cols-2 gap-3 sm:gap-4 text-[11px] sm:text-xs text-gray-500 font-medium">
                    <span class="flex items-center gap-2"><i class="fas fa-undo text-brand-red text-sm"></i> 7 Days Replacement</span>
                    <span class="flex items-center gap-2"><i class="fas fa-shield-alt text-brand-red text-sm"></i> 1 Year Warranty</span>
                    <span class="flex items-center gap-2"><i class="fas fa-truck text-brand-red text-sm"></i> Nationwide Delivery</span>
                    <span class="flex items-center gap-2"><i class="fas fa-check-circle text-brand-red text-sm"></i> 100% Authentic</span>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: Product Details & Rules -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Product Description (Takes up 2/3 width on desktop) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50/80 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100">
                <h2 class="text-sm sm:text-base font-bold text-gray-800">Product Details</h2>
            </div>
            <div class="p-4 sm:p-6 text-[13px] sm:text-sm text-gray-600 leading-relaxed prose prose-sm max-w-none">
                {!! $product->description ?? 'Detailed description and specifications for this product will be provided here. Please feel free to reach out to our support team for specific measurements, material details, or custom modification requests.' !!}
            </div>
        </div>

        <!-- Rules of Product Purchase (Takes up 1/3 width on desktop) -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-brand-red/20 overflow-hidden">
            <div class="bg-brand-red/5 px-4 sm:px-6 py-3 sm:py-4 border-b border-brand-red/10 flex items-center gap-2">
                <i class="fas fa-info-circle text-brand-red"></i>
                <h2 class="text-sm sm:text-base font-bold text-gray-800">Purchase Policies</h2>
            </div>
            <div class="p-4 sm:p-6 text-[12px] sm:text-[13px] text-gray-600 leading-relaxed space-y-4">
                <ul class="space-y-3">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-brand-red mt-1 text-[10px]"></i>
                        <span><strong>Order Confirmation:</strong> 50% advance payment is required to confirm orders, especially for custom-sized items.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-brand-red mt-1 text-[10px]"></i>
                        <span><strong>Delivery Time:</strong> Standard products are delivered within 3-7 days. Custom orders require 10-15 business days.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-brand-red mt-1 text-[10px]"></i>
                        <span><strong>Delivery Charges:</strong> Standard rates apply inside Dhaka. Outside Dhaka deliveries are processed via reliable courier services at the buyer's expense.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-brand-red mt-1 text-[10px]"></i>
                        <span><strong>Installation:</strong> Professional installation is available inside Dhaka for an additional charge.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-brand-red mt-1 text-[10px]"></i>
                        <span><strong>Warranty:</strong> Includes a 1-year service warranty covering manufacturing defects. Physical damage post-delivery is not covered.</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <!-- RELATED PRODUCTS LIST -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="mt-16 sm:mt-24">
        <div class="flex items-center justify-between mb-6 sm:mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Related Products</h2>
            @if($product->category)
                <a href="{{ route('category.show', $product->category->slug) }}" class="text-brand-red font-medium hover:underline text-sm sm:text-base">View Category</a>
            @endif
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
            @foreach($relatedProducts as $related)
                <!-- Product Card -->
                <div class="group relative bg-white transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gray-100 aspect-square sm:aspect-[4/5] overflow-hidden relative mb-2 sm:mb-4 rounded-lg shadow-sm">
                        
                        @if($related->sale_price)
                            <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-red-500 text-white text-[8px] sm:text-[10px] uppercase font-bold px-1.5 sm:px-2.5 py-0.5 sm:py-1 z-20 rounded tracking-wider shadow-sm">Sale</span>
                        @endif
                        
                        <a href="{{ route('product.show', $related->slug) }}" class="block w-full h-full">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" 
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-105" 
                                 alt="{{ $related->name }}">
                        </a>
                        
                        <!-- Desktop Add to Cart (Hover) -->
                        <div class="hidden sm:flex absolute inset-x-0 bottom-4 justify-center opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 px-4">
                            <form action="{{ route('cart.add', $related->id) }}" method="POST" class="w-full m-0">
                                @csrf
                                <button type="submit" class="w-full bg-brand-dark text-white px-4 py-2 sm:py-3 rounded text-xs sm:text-sm font-medium shadow-lg hover:bg-brand-red transition flex justify-center items-center gap-2">
                                    <i class="fas fa-shopping-cart text-[10px] sm:text-xs"></i> Add to cart
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="px-1 sm:px-2">
                        <p class="text-[9px] sm:text-xs text-gray-400 mb-0.5 sm:mb-1.5 uppercase tracking-wider font-medium line-clamp-1">{{ $related->category->name ?? '' }}</p>
                        
                        <h3 class="text-xs sm:text-base font-semibold text-gray-900 mb-0.5 sm:mb-1 line-clamp-2 sm:line-clamp-1 h-[32px] sm:h-auto">
                            <a href="{{ route('product.show', $related->slug) }}" class="hover:text-brand-red transition">{{ $related->name }}</a>
                        </h3>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mt-1 sm:mt-0">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                @if($related->sale_price)
                                    <p class="text-gray-400 line-through text-[10px] sm:text-sm">৳{{ number_format($related->price, 2) }}</p>
                                    <p class="text-brand-red font-bold text-xs sm:text-base">৳{{ number_format($related->sale_price, 2) }}</p>
                                @else
                                    <p class="text-brand-dark font-bold text-xs sm:text-base">৳{{ number_format($related->price, 2) }}</p>
                                @endif
                            </div>
                            
                            <!-- Mobile Quick Add -->
                            <form action="{{ route('cart.add', $related->id) }}" method="POST" class="sm:hidden w-full mt-1">
                                @csrf
                                <button type="submit" class="w-full bg-brand-dark text-white py-1.5 rounded-md text-[10px] font-medium hover:bg-brand-red transition flex justify-center items-center">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

<!-- JavaScript for Image Gallery & Quantity -->
<script>
    // Swap Main Image
    function changeImage(src, element) {
        document.getElementById('mainImage').src = src;
        
        // Remove active border from all thumbnails
        let thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumb => {
            thumb.classList.remove('border-brand-red');
            thumb.classList.add('border-transparent');
        });
        
        // Add active border to clicked thumbnail
        element.classList.remove('border-transparent');
        element.classList.add('border-brand-red');
    }

    // Quantity Increment/Decrement
    function incQty() {
        let input = document.getElementById('qty');
        input.value = parseInt(input.value) + 1;
    }

    function decQty() {
        let input = document.getElementById('qty');
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>

@endsection