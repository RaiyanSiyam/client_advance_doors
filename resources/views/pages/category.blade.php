@extends('layouts.app')

@section('content')
<!-- Category Header & Breadcrumbs -->
<div class="bg-gray-50 pt-32 pb-12 border-b border-gray-200 mt-[-80px]"> <!-- mt-[-80px] to offset the fixed header -->
    <div class="container mx-auto px-4 max-w-7xl">
        <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="{{ route('home') ?? '/' }}" class="hover:text-brand-red transition">Home</a>
                    <i class="fas fa-chevron-right text-[10px] mx-3 text-gray-400"></i>
                </li>
                <li class="flex items-center">
                    <!-- Dynamically show the category name here -->
                    <span class="text-gray-900 font-medium">{{ $category->name ?? 'Doors' }}</span>
                </li>
            </ol>
        </nav>
        
        <h1 class="text-4xl md:text-5xl font-bold text-brand-dark tracking-tight">
            {{ $category->name ?? 'Doors' }}
        </h1>
        <p class="text-gray-500 mt-3 max-w-2xl">
            {{ $category->description ?? 'Explore our premium selection of highly crafted products designed to elevate your living spaces with style and durability.' }}
        </p>
    </div>
</div>

<!-- Main Shop Content -->
<div class="container mx-auto px-4 py-12 max-w-7xl">
    
    <!-- Toolbar (Sorting & Results Count) -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 pb-4 border-b border-gray-100 gap-4">
        <p class="text-gray-500 text-sm">
            Showing <span class="font-medium text-gray-900">1–12</span> of <span class="font-medium text-gray-900">24</span> results
        </p>
        
        <div class="flex items-center gap-4">
            <label for="sortBy" class="text-sm text-gray-600 hidden sm:block">Sort by:</label>
            <div class="relative">
                <select id="sortBy" class="appearance-none bg-white border border-gray-200 text-gray-700 py-2 pl-4 pr-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-brand-red transition cursor-pointer text-sm">
                    <option value="default">Default sorting</option>
                    <option value="popularity">Sort by popularity</option>
                    <option value="rating">Sort by average rating</option>
                    <option value="latest">Sort by latest</option>
                    <option value="price_low">Sort by price: low to high</option>
                    <option value="price_high">Sort by price: high to low</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Standard Loop for Dynamic Products -->
        @forelse($products ?? [1, 2, 3, 4, 5, 6, 7, 8] as $product)
            <!-- Product Card -->
            <div class="group relative bg-white transition-all duration-300 hover:-translate-y-1">
                <!-- Image Wrapper -->
                <div class="bg-gray-100 aspect-[4/5] overflow-hidden relative mb-4 rounded-lg">
                    
                    <!-- Sale Badge (Optional Logic) -->
                    @if(isset($product->discount_price) || $loop->iteration % 3 == 0)
                        <span class="absolute top-3 left-3 bg-red-500 text-white text-[10px] uppercase font-bold px-2.5 py-1 z-10 rounded tracking-wider shadow-sm">Sale</span>
                    @endif

                    <!-- Product Image -->
                    <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
                         alt="{{ $product->name ?? 'Solid Wood Door' }}">
                    
                    <!-- Hover Action Overlay -->
                    <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>
                    
                    <!-- Add to Cart Button (Slides up on hover) -->
                    <div class="absolute inset-x-0 bottom-4 flex justify-center opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20 px-4">
                        <form action="{{ route('cart.add', $product->id ?? 1) }}" method="POST" class="w-full m-0">
                            @csrf
                            <button type="submit" class="w-full bg-brand-dark text-white px-4 py-3 rounded text-sm font-medium shadow-lg hover:bg-brand-red transition flex justify-center items-center gap-2">
                                <i class="fas fa-shopping-cart text-xs"></i> Add to cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="px-1">
                    <!-- Subcategory -->
                    <p class="text-xs text-gray-400 mb-1.5 uppercase tracking-wider font-medium">
                        {{ $category->name ?? 'Solid Wood' }}
                    </p>
                    
                    <!-- Title -->
                    <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-1">
                        <a href="{{ route('product.show', $product->slug ?? $product->id ?? 1) }}" class="hover:text-brand-red transition">
                            {{ $product->name ?? 'Premium Mahogany Door Set ' . $loop->iteration }}
                        </a>
                    </h3>
                    
                    <!-- Price -->
                    <div class="flex items-center gap-2">
                        @if(isset($product->discount_price) || $loop->iteration % 3 == 0)
                            <p class="text-gray-400 line-through text-sm">${{ number_format($product->old_price ?? 350.00, 2) }}</p>
                            <p class="text-brand-red font-bold">${{ number_format($product->price ?? 280.00, 2) }}</p>
                        @else
                            <p class="text-brand-dark font-bold">${{ number_format($product->price ?? 350.00, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No products found in this category.</p>
                <a href="{{ route('home') ?? '/' }}" class="inline-block mt-4 px-6 py-2 bg-brand-dark text-white rounded-md hover:bg-brand-red transition">Return to Home</a>
            </div>
        @endforelse

    </div>

    <!-- Pagination (Laravel default styles adapted for Tailwind) -->
    <div class="mt-16 flex justify-center">
        <!-- Replace this mock with {{ $products->links() }} when wiring to backend -->
        <nav class="flex items-center gap-2" aria-label="Pagination">
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-brand-red transition">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded bg-brand-dark text-white font-medium hover:bg-brand-red transition">1</a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded border border-gray-200 text-gray-700 hover:bg-gray-50 hover:text-brand-red transition">2</a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded border border-gray-200 text-gray-700 hover:bg-gray-50 hover:text-brand-red transition">3</a>
            <span class="px-2 text-gray-400">...</span>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-brand-red transition">
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        </nav>
    </div>

</div>
@endsection