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
                                        <span class="text-sm font-bold text-zinc-900">৳{{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-xs text-zinc-400 line-through">৳{{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="text-sm font-bold text-zinc-900">৳{{ number_format($product->price, 2) }}</span>
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
                                     <button type="button" onclick="openDeleteModal('{{ route('admin.products.destroy', $product->id) }}')" class="text-red-500 hover:text-red-700 transform hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
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

<!-- DELETE CONFIRMATION MODAL -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDeleteModal()"></div>

        <!-- Center modal trick -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal Panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Item</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to delete this item? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        Yes, Delete
                    </button>
                </form>
                <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl) {
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>


@endsection