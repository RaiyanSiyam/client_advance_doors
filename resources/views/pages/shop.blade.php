@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-1/4">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Categories</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('shop') }}" class="text-gray-600 hover:text-amber-600 block {{ !request('category') ? 'font-bold text-amber-600' : '' }}">
                            All Products
                        </a>
                    </li>
                    @if(isset($categories))
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('shop', ['category' => $category->slug]) }}" class="text-gray-600 hover:text-amber-600 block {{ request('category') == $category->slug ? 'font-bold text-amber-600' : '' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </aside>

        <!-- Product Grid -->
        <main class="w-full md:w-3/4">
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ request('category') ? ucfirst(str_replace('-', ' ', request('category'))) : 'All Products' }}
                </h1>
                <span class="text-gray-500 text-sm">Showing results</span>
            </div>

            @if(isset($products) && $products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-lg transition">
                        <a href="/product/{{ $product->slug }}">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/400x500?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                        </a>
                        <div class="p-4">
                            <p class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? '' }}</p>
                            <a href="/product/{{ $product->slug }}" class="block font-bold text-gray-900 hover:text-amber-600 mb-2 truncate">{{ $product->name }}</a>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <span class="text-lg font-bold text-amber-600">৳{{ number_format($product->active_price) }}</span>
                                    @if($product->sale_price)
                                        <span class="text-sm text-gray-400 line-through ml-2">৳{{ number_format($product->price) }}</span>
                                    @endif
                                </div>
                                <form action="/cart/add/{{ $product->id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-slate-900 text-white p-2 rounded hover:bg-amber-600 transition">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white p-8 text-center rounded-lg shadow-sm border border-gray-100">
                    <i class="fas fa-box-open text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">No products found in this category.</p>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection