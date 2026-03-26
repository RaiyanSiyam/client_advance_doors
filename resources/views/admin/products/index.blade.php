@extends('admin.layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Catalog Management</h1>
            <p class="text-gray-600 text-sm mt-1">Manage your products, categories, and inventory.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-zinc-900 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-black shadow-lg shadow-zinc-900/20 transition-all flex items-center gap-2 text-sm">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <!-- Categories Section (Updated to show database images) -->
    <div class="mb-8">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Categories</h2>
        <p class="text-gray-500 text-sm mb-4">Filter products by category.</p>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl border {{ !request('category_id') ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 bg-white text-zinc-700 hover:border-zinc-300 hover:bg-zinc-50' }} transition-all shadow-sm">
                <div class="w-10 h-10 rounded-full {{ !request('category_id') ? 'bg-zinc-800' : 'bg-zinc-100' }} flex items-center justify-center">
                    <i class="fas fa-th-large {{ !request('category_id') ? 'text-white' : 'text-zinc-500' }}"></i>
                </div>
                <div>
                    <p class="font-bold text-sm">All Products</p>
                    <p class="text-xs {{ !request('category_id') ? 'text-zinc-300' : 'text-zinc-500' }}">{{ $categories->sum('products_count') }} Items</p>
                </div>
            </a>

            @foreach($categories as $category)
            <a href="{{ route('admin.products.index', ['category_id' => $category->id]) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl border {{ request('category_id') == $category->id ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 bg-white text-zinc-700 hover:border-zinc-300 hover:bg-zinc-50' }} transition-all shadow-sm">
                <div class="w-10 h-10 rounded-full {{ request('category_id') == $category->id ? 'bg-zinc-800' : 'bg-zinc-100' }} flex items-center justify-center overflow-hidden shrink-0">
                    <!-- Fix 1: Load category images safely -->
                    @if(!empty($category->image))
                        <img src="{{ Str::startsWith($category->image, ['http://', 'https://']) ? $category->image : asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-folder {{ request('category_id') == $category->id ? 'text-white' : 'text-zinc-500' }}"></i>
                    @endif
                </div>
                <div>
                    <p class="font-bold text-sm">{{ $category->name }}</p>
                    <p class="text-xs {{ request('category_id') == $category->id ? 'text-zinc-300' : 'text-zinc-500' }}">{{ $category->products_count }} Items</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Products Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
        <div class="p-6 border-b border-zinc-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Products</h2>
                <p class="text-gray-500 text-sm">Manage your inventory.</p>
            </div>
            
            <!-- Search Form -->
            <form action="{{ route('admin.products.index') }}" method="GET" class="w-full sm:w-auto flex items-center gap-2">
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                <div class="relative w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or SKU..." class="w-full pl-9 pr-4 py-2 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 outline-none transition-all">
                </div>
                <button type="submit" class="px-4 py-2 bg-zinc-100 text-zinc-700 rounded-xl text-sm font-semibold hover:bg-zinc-200 transition-colors border border-zinc-200">
                    Search
                </button>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-red-50 text-red-600 rounded-xl text-sm font-semibold hover:bg-red-100 transition-colors border border-red-100">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-50 border-b border-zinc-200">
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Product</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">SKU</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Category</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Price & Sale</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Stock</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-zinc-50/50 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl border border-zinc-200 overflow-hidden bg-zinc-100 shrink-0">
                                        <!-- Fix 2: Load product images safely from the Storage disk -->
                                        @if(!empty($product->main_image))
                                            <img src="{{ Str::startsWith($product->main_image, ['http://', 'https://']) ? $product->main_image : asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-zinc-800 text-sm line-clamp-1">{{ $product->name }}</p>
                                        <p class="text-xs text-zinc-500 mt-0.5 line-clamp-1">{{ Str::limit(strip_tags($product->description), 40) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-md bg-zinc-100 border border-zinc-200 text-xs font-mono font-medium text-zinc-600">
                                    {{ $product->sku ?: 'N/A' }}
                                </span>
                            </td>
                            <td class="p-4">
                                @if($product->category)
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-blue-50 border border-blue-100 text-xs font-semibold text-blue-600">
                                        {{ $product->category->name }}
                                    </span>
                                @else
                                    <span class="text-zinc-400 text-xs">Uncategorized</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex flex-col">
                                    <!-- Fix 4: Safely display Sale Price if it exists and is less than regular price -->
                                    @if(!empty($product->sale_price) && $product->sale_price > 0 && $product->sale_price < $product->price)
                                        <span class="text-sm font-bold text-red-600">৳ {{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-xs text-zinc-400 line-through">৳ {{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="text-sm font-bold text-zinc-800">৳ {{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-sm font-semibold {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $product->stock ?? 0 }}
                                </span>
                            </td>
                            <td class="p-4">
                                @php
                                    // Fallback to check multiple common status definitions
                                    $isActive = $product->status === 'active' || $product->status === 1 || $product->is_active === 1;
                                @endphp
                                @if($isActive)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-50 border border-green-200 text-xs font-bold text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-xs font-bold text-zinc-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="w-8 h-8 rounded-lg bg-white border border-zinc-200 flex items-center justify-center text-zinc-500 hover:text-blue-600 hover:border-blue-200 hover:bg-blue-50 transition-colors" title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-white border border-zinc-200 flex items-center justify-center text-zinc-500 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-colors" title="Delete">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-zinc-500">
                                <div class="w-16 h-16 mx-auto bg-zinc-100 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-box-open text-2xl text-zinc-400"></i>
                                </div>
                                <p class="font-medium text-zinc-800">No products found</p>
                                <p class="text-sm mt-1">Try adjusting your search or category filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        @if($products->hasPages())
            <div class="p-4 border-t border-zinc-200 bg-zinc-50">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection