@extends('admin.layouts.admin')

@section('header_title', 'Edit Product')
@section('header_subtitle', 'Update details for ' . $product->name)

@section('content')
<div class="max-w-4xl mx-auto" x-data="productImageManagerEdit()">
    
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.products.index') }}" class="text-zinc-500 hover:text-zinc-900 transition-colors flex items-center gap-2 text-sm font-semibold w-fit px-3 py-1.5 rounded-lg hover:bg-zinc-100 -ml-3">
            <i class="fas fa-arrow-left text-xs"></i> Back to Catalog
        </a>
        <a href="#" target="_blank" class="text-red-600 hover:text-red-700 font-bold text-sm flex items-center gap-1.5">
            View on Store <i class="fas fa-external-link-alt text-xs"></i>
        </a>
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

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-zinc-100">
                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fas fa-pen"></i>
                </div>
                <h2 class="text-lg font-bold text-zinc-900">Basic Information</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-zinc-50/50 border border-zinc-200 p-3 rounded-xl focus:outline-none focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category_id" class="w-full bg-zinc-50/50 border border-zinc-200 p-3 rounded-xl focus:outline-none focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm appearance-none" required>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full bg-zinc-50/50 border border-zinc-200 p-3 rounded-xl focus:outline-none focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm font-mono">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Regular Price (৳) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-zinc-50/50 border border-zinc-200 p-3 rounded-xl focus:outline-none focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-zinc-700 mb-2">Sale Price (৳)</label>
                    <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="w-full bg-zinc-50/50 border border-zinc-200 p-3 rounded-xl focus:outline-none focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-zinc-700 mb-2">Full Details</label>
                <textarea name="description" rows="5" class="w-full bg-zinc-50/50 border border-zinc-200 p-3 rounded-xl focus:outline-none focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all text-sm">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-zinc-100">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-zinc-100">
                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fas fa-images"></i>
                </div>
                <h2 class="text-lg font-bold text-zinc-900">Product Media</h2>
            </div>
            
            <!-- Main Image Editor -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-zinc-700 mb-2">Main Cover Image</label>
                <div class="relative border border-zinc-200 rounded-xl bg-zinc-50 hover:border-red-300 transition-colors group flex items-center justify-center overflow-hidden h-64">
                    
                    <input type="file" name="image" @change="previewMain" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*">
                    
                    <!-- Pre-loaded or New Preview Image -->
                    <div class="w-full h-full relative flex justify-center">
                        <img :src="mainPreview || '{{ $product->image ?? 'https://via.placeholder.com/800' }}'" class="h-full object-contain">
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white backdrop-blur-sm">
                            <i class="fas fa-camera text-2xl mb-2"></i>
                            <span class="text-sm font-semibold">Click to Replace Cover</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Images Editor -->
            <div class="mb-6 border-t border-zinc-100 pt-8">
                <div class="flex justify-between items-end mb-4">
                    <label class="block text-sm font-semibold text-zinc-700">Gallery Photos</label>
                </div>

                <!-- Existing Gallery Images (Mockup Example) -->
                @if(isset($product->gallery) && count($product->gallery) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4 mb-6 pb-6 border-b border-zinc-100 border-dashed">
                        @foreach($product->gallery as $photo)
                            <div class="relative group aspect-square rounded-xl border border-zinc-200 overflow-hidden bg-zinc-50">
                                <img src="{{ $photo->url }}" class="w-full h-full object-cover">
                                <!-- Checkbox to delete existing image -->
                                <label class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center cursor-pointer transition-opacity z-10">
                                    <div class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1">
                                        <input type="checkbox" name="delete_gallery[]" value="{{ $photo->id }}" class="rounded text-red-600 focus:ring-0 w-3 h-3"> Delete
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Upload NEW gallery images -->
                <div class="border-2 border-dashed border-zinc-200 rounded-xl p-6 text-center bg-zinc-50/50 hover:bg-zinc-50 hover:border-red-300 transition-colors group relative mb-4">
                    <input type="file" name="new_gallery[]" multiple @change="previewGallery" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*">
                    <div class="flex items-center justify-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-zinc-100 group-hover:text-red-600 transition-all text-zinc-400">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-zinc-800">Add More Photos</p>
                            <p class="text-xs text-zinc-500">Select multiple files</p>
                        </div>
                    </div>
                </div>

                <!-- New Previews Grid -->
                <div x-show="galleryPreviews.length > 0" class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4">
                    <template x-for="(src, index) in galleryPreviews" :key="index">
                        <div class="relative group aspect-square rounded-xl border-2 border-green-200 overflow-hidden bg-zinc-50">
                            <div class="absolute top-0 left-0 bg-green-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-br-lg z-10">NEW</div>
                            <img :src="src" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
            </div>

            <!-- Settings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 pt-8 border-t border-zinc-100">
                <label class="flex items-start p-4 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors has-[:checked]:border-red-500 has-[:checked]:bg-red-50/30">
                    <div class="flex items-center h-5">
                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 text-red-600 rounded border-zinc-300 focus:ring-red-500" {{ $product->is_active ? 'checked' : '' }}>
                    </div>
                    <div class="ml-3 text-sm">
                        <span class="font-bold text-zinc-900 block">Publish Product</span>
                        <span class="text-zinc-500 text-xs">Make this product visible on storefront.</span>
                    </div>
                </label>
            </div>
        </div>

        <!-- Sticky Footer -->
        <div class="flex justify-end gap-3 sticky bottom-4 bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-zinc-100 z-20">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-zinc-600 hover:bg-zinc-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-zinc-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-zinc-900/20 transition-all active:scale-95 flex items-center gap-2 text-sm">
                <i class="fas fa-sync-alt"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<!-- Alpine Script for Previews -->
<script>
    function productImageManagerEdit() {
        return {
            mainPreview: null,
            galleryPreviews: [],
            
            previewMain(event) {
                const file = event.target.files[0];
                if (file) {
                    this.mainPreview = URL.createObjectURL(file);
                }
            },
            
            previewGallery(event) {
                const files = Array.from(event.target.files);
                this.galleryPreviews = files.map(file => URL.createObjectURL(file));
            }
        }
    }
</script>
@endsection