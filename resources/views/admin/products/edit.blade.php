@extends('admin.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
            <p class="text-gray-600 text-sm mt-1">Update details for <span class="font-semibold">{{ $product->name }}</span></p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.products.index') }}" class="text-zinc-600 hover:text-zinc-900 bg-white border border-zinc-200 hover:bg-zinc-50 font-semibold px-4 py-2 rounded-xl transition-all shadow-sm text-sm flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i> Back to Catalog
            </a>
            <a href="{{ route('product.show', $product->slug ?? '#') }}" target="_blank" class="text-blue-600 hover:text-blue-700 bg-blue-50 border border-blue-100 font-semibold px-4 py-2 rounded-xl transition-all shadow-sm text-sm flex items-center gap-2">
                View on Store <i class="fas fa-external-link-alt text-xs"></i>
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-xl flex gap-3 shadow-sm">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="pb-10">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Main Details (Takes up 2/3 of space) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- General Info Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">General Information</h2>
                    
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Category <span class="text-red-500">*</span></label>
                            <select name="category_id" required class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5 bg-white">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">SKU (Stock Keeping Unit)</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                    </div>
                </div>

                <!-- Pricing & Inventory Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Pricing & Inventory</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Price ($) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Sale Price ($)</label>
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Stock Quantity</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                    </div>
                </div>

                <!-- Descriptions Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Product Descriptions</h2>
                    
                    <!-- MISSING SHORT DESCRIPTION ADDED HERE -->
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Short Description</label>
                        <p class="text-xs text-zinc-500 mb-2">A quick summary of the product (usually displayed on product cards or right next to the image).</p>
                        <textarea name="short_description" rows="3" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-3">{{ old('short_description', $product->short_description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Full Description</label>
                        <p class="text-xs text-zinc-500 mb-2">Comprehensive details about the product, features, and specifications.</p>
                        <textarea name="description" rows="6" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-3">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column: Media & Status (Takes up 1/3 of space) -->
            <div class="space-y-8">
                
                <!-- Media Upload Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Product Media</h2>
                    
                    <!-- Main Image (Alpine.js handled) -->
                    <div x-data="{ mainPreview: null }">
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Main Image</label>
                        
                        <!-- Image Container -->
                        <div class="relative w-full aspect-square bg-zinc-50 rounded-xl border border-zinc-200 overflow-hidden group">
                            <!-- Show existing image if no new file is selected -->
                            <div x-show="!mainPreview" class="w-full h-full">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover" alt="Current Image">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-zinc-400">
                                        <i class="far fa-image text-3xl mb-2"></i>
                                        <span class="text-sm">No image</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Show new image preview -->
                            <div x-show="mainPreview" style="display: none;" class="w-full h-full">
                                <img :src="mainPreview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 ring-4 ring-inset ring-blue-500 rounded-xl pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- File Input -->
                        <div class="mt-3 relative">
                            <input type="file" name="image" accept="image/*" @change="mainPreview = URL.createObjectURL($event.target.files[0])" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 transition-all cursor-pointer">
                        </div>
                    </div>

                    <hr class="border-zinc-100">

                    <!-- Gallery Images (Alpine.js handled) -->
                    <div x-data="{ newGalleryPreviews: [] }">
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Gallery Images</label>
                        <p class="text-xs text-zinc-500 mb-3 leading-relaxed">Uploading new files will <strong>replace</strong> the current gallery entirely.</p>
                        
                        <!-- Existing Gallery (Hides if new files are selected) -->
                        <div x-show="newGalleryPreviews.length === 0" class="grid grid-cols-3 gap-2">
                            @php $gallery = json_decode($product->gallery) ?? []; @endphp
                            
                            @forelse($gallery as $img)
                                <div class="aspect-square relative rounded-lg border border-zinc-200 overflow-hidden">
                                    <img src="{{ asset($img) }}" class="w-full h-full object-cover">
                                </div>
                            @empty
                                <div class="col-span-3 aspect-[3/1] flex flex-col items-center justify-center bg-zinc-50 border border-dashed border-zinc-300 rounded-lg text-zinc-400">
                                    <i class="far fa-images text-xl mb-1"></i>
                                    <span class="text-xs">Empty Gallery</span>
                                </div>
                            @endforelse
                        </div>

                        <!-- New Gallery Previews -->
                        <div x-show="newGalleryPreviews.length > 0" style="display: none;" class="grid grid-cols-3 gap-2">
                            <template x-for="(preview, index) in newGalleryPreviews" :key="index">
                                <div class="aspect-square relative rounded-lg border-2 border-blue-400 shadow-sm overflow-hidden">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </div>
                            </template>
                        </div>

                        <!-- File Input -->
                        <div class="mt-3 relative">
                            <input type="file" name="gallery[]" multiple accept="image/*" @change="newGalleryPreviews = Array.from($event.target.files).map(f => URL.createObjectURL(f))" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 transition-all cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Status & Visibility Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Status</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="relative flex items-center h-5 mt-0.5">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900 transition-colors">
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-zinc-800 group-hover:text-zinc-600 transition-colors">Active Product</span>
                                <span class="text-xs text-zinc-500 mt-0.5">Visible and purchasable on the storefront.</span>
                            </div>
                        </label>

                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="relative flex items-center h-5 mt-0.5">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-5 h-5 rounded border-zinc-300 text-yellow-500 focus:ring-yellow-500 transition-colors">
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-zinc-800 group-hover:text-zinc-600 transition-colors">Featured</span>
                                <span class="text-xs text-zinc-500 mt-0.5">Highlight this product in special sections.</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Footer for Save Button -->
        <div class="flex justify-end gap-3 sticky bottom-6 bg-white/90 backdrop-blur-md p-4 mt-8 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-zinc-100 z-20">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-zinc-600 hover:bg-zinc-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-zinc-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-zinc-900/20 transition-all active:scale-95 flex items-center gap-2 text-sm">
                <i class="fas fa-sync-alt"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection