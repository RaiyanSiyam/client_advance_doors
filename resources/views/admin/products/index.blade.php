@extends('admin.layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Catalog Management</h1>
            <p class="text-gray-600 text-sm mt-1">Manage your products, categories, and inventory.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-zinc-900 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-black shadow-lg shadow-zinc-900/20 transition-all flex items-center gap-2 text-sm">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <div class="mb-8">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Categories</h2>
        <p class="text-gray-500 text-sm mb-4">Filter products by category.</p>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.products.index', ['search' => request('search')]) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl border {{ !request('category_id') ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 bg-white hover:border-zinc-300 hover:shadow-md' }} transition-all">
                <span class="font-bold">All</span>
            </a>
            
            @foreach($categories->whereNull('parent_id') as $category)
                <div class="relative group">
                    <a href="{{ route('admin.products.index', ['category_id' => $category->id, 'search' => request('search')]) }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl border {{ request('category_id') == $category->id ? 'border-zinc-900 bg-zinc-900 text-white' : 'border-zinc-200 bg-white hover:border-zinc-300 hover:shadow-md' }} transition-all">
                        @if($category->image)
                            <div class="w-8 h-8 rounded-lg overflow-hidden bg-zinc-100 flex-shrink-0">
                                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-8 h-8 rounded-lg bg-zinc-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-folder {{ request('category_id') == $category->id ? 'text-zinc-300' : 'text-zinc-400' }}"></i>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <span class="text-sm font-bold {{ request('category_id') == $category->id ? 'text-white' : 'text-zinc-800' }}">{{ $category->name }}</span>
                        </div>
                    </a>

                    @php
                        $subCategories = $categories->where('parent_id', $category->id);
                    @endphp
                    @if($subCategories->count() > 0)
                        <div class="absolute left-0 top-full mt-2 w-48 bg-white border border-zinc-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-2 flex flex-col gap-1">
                                @foreach($subCategories as $sub)
                                    <a href="{{ route('admin.products.index', ['category_id' => $sub->id, 'search' => request('search')]) }}" class="block px-3 py-2 text-sm {{ request('category_id') == $sub->id ? 'bg-zinc-100 font-bold text-zinc-900' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50' }} rounded-lg transition-colors">
                                        {{ $sub->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="mb-6 flex flex-col sm:flex-row gap-4 items-center justify-between bg-white p-4 rounded-2xl border border-zinc-200 shadow-sm">
        <div class="flex items-center w-full sm:w-auto">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center gap-2 w-full">
                @if(request('category_id'))
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                @endif
                
                <div class="relative w-full sm:w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full pl-9 pr-4 py-2 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all outline-none">
                </div>

                <button type="submit" class="px-4 py-2 bg-zinc-900 text-white font-bold rounded-xl text-sm hover:bg-black transition-colors">
                    Search
                </button>

                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-red-50 text-red-600 border border-red-100 font-bold rounded-xl text-sm hover:bg-red-100 transition-colors whitespace-nowrap">
                        Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-zinc-50 border-b border-zinc-200">
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Product</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">SKU</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Category</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Price</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Stock</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status</th>
                        <th class="p-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="p-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-zinc-100 overflow-hidden flex-shrink-0 border border-zinc-200">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-zinc-900 text-sm">{{ $product->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle text-sm text-zinc-600 font-medium">{{ $product->sku ?? 'N/A' }}</td>
                            <td class="p-4 align-middle text-sm text-zinc-600">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-zinc-100 text-zinc-700 text-xs font-medium">
                                    {{ $product->category ? $product->category->name : 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="flex flex-col">
                                    @if($product->sale_price)
                                        <span class="text-sm font-bold text-zinc-900">${{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-xs text-zinc-400 line-through">${{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="text-sm font-bold text-zinc-900">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <span class="text-sm font-medium {{ $product->stock_quantity > 10 ? 'text-emerald-600' : ($product->stock_quantity > 0 ? 'text-amber-600' : 'text-red-600') }}">
                                    {{ $product->stock_quantity }} in stock
                                </span>
                            </td>
                            <td class="p-4 align-middle">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-zinc-100 text-zinc-600 border border-zinc-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $product->is_active ? 'bg-emerald-500' : 'bg-zinc-400' }}"></span>
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="w-8 h-8 rounded-lg bg-white border border-zinc-200 flex items-center justify-center text-zinc-500 hover:text-zinc-900 hover:border-zinc-300 hover:bg-zinc-50 transition-colors" title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
        
        @if($products->hasPages())
            <div class="p-4 border-t border-zinc-200 bg-zinc-50">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection