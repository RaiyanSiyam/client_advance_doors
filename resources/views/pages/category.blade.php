@extends('layouts.app')

@section('content')

<style>
    /* Utility to hide scrollbars for sleek swiping */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

@if(isset($subcategories) && $subcategories->count() > 0)
    <div class="pt-20 pb-6 lg:pt-20 lg:pb-10 overflow-hidden bg-transparent border-b border-gray-100">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex flex-col md:flex-row items-center gap-6 lg:gap-12">
                
                <div class="w-full md:w-1/2 flex flex-col items-start z-10">
                    <nav class="text-xs sm:text-sm mb-3 sm:mb-6" aria-label="Breadcrumb">
                        <ol class="list-none p-0 inline-flex items-center space-x-2 text-gray-500">
                            <li><a href="{{ route('home') ?? '/' }}" class="hover:text-brand-red transition">Home</a></li>
                            <li><i class="fas fa-chevron-right text-[8px] sm:text-[10px] text-gray-400 mx-1"></i></li>
                            
                            @if($category->parent)
                                <li><a href="{{ route('category.show', $category->parent->slug) }}" class="hover:text-brand-red transition">{{ $category->parent->name }}</a></li>
                                <li><i class="fas fa-chevron-right text-[8px] sm:text-[10px] text-gray-400 mx-1"></i></li>
                            @endif
                            
                            <li class="text-gray-900 font-medium">{{ $category->name }}</li>
                        </ol>
                    </nav>
                    
                    <h1 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold tracking-tight text-brand-dark mb-3 sm:mb-4">
                        {{ $category->name }}
                    </h1>
                    
                    <p class="text-[13px] sm:text-base text-gray-600 leading-relaxed border-l-2 sm:border-l-4 border-brand-red pl-3 sm:pl-4">
                        {{ $category->description ?? 'Discover our carefully curated collection of ' . strtolower($category->name) . '. Each piece is designed to seamlessly blend modern aesthetics with timeless durability, transforming your house into a home.' }}
                    </p>
                </div>

                <div class="w-full md:w-1/2">
                    @php
                        // Assign a meaningful default image based on the category if no DB image exists
                        $heroImg = 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                        $catName = strtolower($category->name);
                        
                        if (str_contains($catName, 'door')) {
                            $heroImg = 'https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                        } elseif (str_contains($catName, 'bedroom')) {
                            $heroImg = 'https://images.unsplash.com/photo-1540518614846-7eded433c457?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                        } elseif (str_contains($catName, 'living')) {
                            $heroImg = 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                        }

                        // Override Priority 1: Use the parent category image if available
                        if ($category->parent && $category->parent->image) {
                            $heroImg = asset('storage/' . $category->parent->image);
                        }
                        // Override Priority 2: Fallback to the current category image
                        elseif ($category->image) {
                            $heroImg = asset('storage/' . $category->image);
                        }
                    @endphp
                    
                    <div class="rounded-xl overflow-hidden shadow-md aspect-[21/9] sm:aspect-[16/9] md:aspect-[4/3] lg:aspect-[16/9] relative group">
                        <img src="{{ $heroImg }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/10 to-transparent pointer-events-none"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@else
    <div class="bg-transparent pt-28 pb-4 sm:pb-6 border-b border-gray-200">
        <div class="container mx-auto px-4 max-w-7xl">
            <nav class="text-xs sm:text-sm mb-2 sm:mb-4" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex items-center space-x-2 text-gray-500">
                    <li><a href="{{ route('home') ?? '/' }}" class="hover:text-brand-red transition">Home</a></li>
                    <li><i class="fas fa-chevron-right text-[8px] sm:text-[10px] text-gray-400 mx-1"></i></li>
                    
                    @if($category->parent)
                        <li><a href="{{ route('category.show', $category->parent->slug) }}" class="hover:text-brand-red transition">{{ $category->parent->name }}</a></li>
                        <li><i class="fas fa-chevron-right text-[8px] sm:text-[10px] text-gray-400 mx-1"></i></li>
                    @endif
                    
                    <li class="text-gray-900 font-medium">{{ $category->name }}</li>
                </ol>
            </nav>
            
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight text-brand-dark">
                {{ $category->name }}
            </h1>
            
            <p class="mt-2 max-w-2xl text-[13px] sm:text-base text-gray-500 leading-relaxed">
                {{ $category->description ?? 'Explore our premium selection of ' . strtolower($category->name) . ', specifically crafted for those who appreciate fine details and unparalleled quality.' }}
            </p>
        </div>
    </div>
@endif


<div class="container mx-auto px-4 py-8 sm:py-12 max-w-7xl">
    
    @if(isset($products) && $products->count() > 0)
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-10 pb-4 border-b border-gray-100 gap-3 sm:gap-4">
            <p class="text-gray-500 text-xs sm:text-sm">
                Showing <span class="font-medium text-gray-900">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span> of <span class="font-medium text-gray-900">{{ $products->total() }}</span> results
            </p>
            
            <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto">
                <label for="sortBy" class="text-xs sm:text-sm text-gray-600 hidden sm:block">Sort by:</label>
                <form action="{{ route('category.show', $category->slug) }}" method="GET" id="sortForm" class="relative w-full sm:w-auto">
                    <select name="sort" id="sortBy" onchange="document.getElementById('sortForm').submit()" class="w-full sm:w-auto appearance-none bg-white border border-gray-200 text-gray-700 py-2 pl-3 sm:pl-4 pr-8 sm:pr-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-brand-red transition cursor-pointer text-xs sm:text-sm">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Recently added</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 sm:px-3 text-gray-500">
                        <i class="fas fa-chevron-down text-[10px] sm:text-xs"></i>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if(isset($subcategories) && $subcategories->count() > 0)
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
            @foreach($subcategories as $subcat)
                <div class="group relative bg-white transition-all duration-300 hover:-translate-y-1 block">
                    <a href="{{ route('category.show', $subcat->slug) }}">
                        <div class="bg-gray-100 aspect-square sm:aspect-[4/5] overflow-hidden relative mb-2 sm:mb-4 rounded-lg shadow-sm">
                            <img src="{{ $subcat->image ? asset('storage/' . $subcat->image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" 
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
                                 alt="{{ $subcat->name }}">
                            <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>
                        </div>
                        
                        <div class="px-1 text-center">
                            <h3 class="text-sm sm:text-lg font-bold text-gray-900 mb-1 group-hover:text-brand-red transition line-clamp-1">
                                {{ $subcat->name }}
                            </h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    @elseif(isset($products))
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
            @forelse($products as $product)
                <div class="group relative bg-white transition-all duration-300 hover:-translate-y-1">
                    
                    <div class="bg-gray-100 aspect-square sm:aspect-[4/5] overflow-hidden relative mb-2 sm:mb-4 rounded-lg shadow-sm group/gallery">
                        
                        @if($product->sale_price)
                            <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-red-500 text-white text-[8px] sm:text-[10px] uppercase font-bold px-1.5 sm:px-2.5 py-0.5 sm:py-1 z-20 rounded tracking-wider shadow-sm">Sale</span>
                        @endif

                        <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar w-full h-full scroll-smooth">
                            
                            <div class="w-full h-full flex-shrink-0 snap-center relative">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" 
                                     class="w-full h-full object-cover" 
                                     alt="{{ $product->name }}">
                            </div>

                            @if(is_array($product->gallery) && count($product->gallery) > 0)
                                @foreach($product->gallery as $galImg)
                                    <div class="w-full h-full flex-shrink-0 snap-center relative">
                                        <img src="{{ asset('storage/' . $galImg) }}" 
                                             class="w-full h-full object-cover" 
                                             alt="{{ $product->name }} view">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>
                        
                        @if(is_array($product->gallery) && count($product->gallery) > 0)
                            <div class="absolute bottom-1.5 sm:bottom-2 left-1/2 -translate-x-1/2 flex gap-1 z-10 pointer-events-none">
                                <div class="w-1 h-1 sm:w-1.5 sm:h-1.5 rounded-full bg-white/90 shadow"></div>
                                <div class="w-1 h-1 sm:w-1.5 sm:h-1.5 rounded-full bg-white/50 shadow"></div>
                            </div>
                        @endif

                        <div class="hidden sm:flex absolute inset-x-0 bottom-4 justify-center opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 px-4">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full m-0">
                                @csrf
                                <button type="submit" class="w-full bg-brand-dark text-white px-4 py-2 sm:py-3 rounded text-xs sm:text-sm font-medium shadow-lg hover:bg-brand-red transition flex justify-center items-center gap-2">
                                    <i class="fas fa-shopping-cart text-[10px] sm:text-xs"></i> Add to cart
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="px-1 sm:px-2">
                        <p class="text-[9px] sm:text-xs text-gray-400 mb-0.5 sm:mb-1.5 uppercase tracking-wider font-medium line-clamp-1">
                            {{ $category->name }}
                        </p>
                        
                        <h3 class="text-xs sm:text-base font-semibold text-gray-900 mb-0.5 sm:mb-1 line-clamp-2 sm:line-clamp-1 h-[32px] sm:h-auto">
                            <a href="{{ route('product.show', $product->slug) }}" class="hover:text-brand-red transition">
                                {{ $product->name }}
                            </a>
                        </h3>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mt-1 sm:mt-0">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                @if($product->sale_price)
                                    <p class="text-gray-400 line-through text-[10px] sm:text-sm">৳{{ number_format($product->price, 2) }}</p>
                                    <p class="text-brand-red font-bold text-xs sm:text-base">৳{{ number_format($product->sale_price, 2) }}</p>
                                @else
                                    <p class="text-brand-dark font-bold text-xs sm:text-base">৳{{ number_format($product->price, 2) }}</p>
                                @endif
                            </div>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="sm:hidden w-full mt-1">
                                @csrf
                                <button type="submit" class="w-full bg-brand-dark text-white py-1.5 rounded-md text-[10px] font-medium hover:bg-brand-red transition flex justify-center items-center">
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 sm:py-20 text-center">
                    <i class="fas fa-box-open text-3xl sm:text-4xl text-gray-300 mb-3 sm:mb-4"></i>
                    <p class="text-gray-500 text-sm sm:text-lg">No products found in this category.</p>
                    <a href="{{ route('home') ?? '/' }}" class="inline-block mt-3 sm:mt-4 px-4 sm:px-6 py-2 text-xs sm:text-sm bg-brand-dark text-white rounded-md hover:bg-brand-red transition">Return to Home</a>
                </div>
            @endforelse
        </div>

        <div class="mt-10 sm:mt-16 flex justify-center">
            @if(method_exists($products, 'links'))
                {{ $products->links() }}
            @endif
        </div>
    @endif

</div>
@endsection