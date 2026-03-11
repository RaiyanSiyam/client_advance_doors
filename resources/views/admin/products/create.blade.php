@extends('admin.layouts.admin')

@section('content')
<!-- IMPORTANT: Removed the parentheses from productImageManager -->
<div class="max-w-4xl mx-auto" x-data="productImageManager">
    
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Product</h1>
        <p class="text-gray-600">Add a new item to your catalog with rich media.</p>
    </div>

    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-zinc-500 hover:text-zinc-900 transition-colors flex items-center gap-2 text-sm font-semibold w-fit px-3 py-1.5 rounded-lg hover:bg-zinc-100 -ml-3">
            <i class="fas fa-arrow-left text-xs"></i> Back to Catalog
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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Basic Details -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-zinc-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Basic Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-shadow">
                </div>

                <!-- Product Code (SKU) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Code (SKU)</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-shadow" placeholder="e.g., AD-DOOR-01">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                    <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                    <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-shadow">
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-medium">৳</span>
                        </div>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <!-- Sale Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sale Price (Optional)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-medium">৳</span>
                        </div>
                        <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price') }}" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Descriptions -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-zinc-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Descriptions</h2>
            <div class="space-y-6">
                <!-- Short Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                    <textarea name="short_description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('short_description') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">A brief summary that appears on product cards.</p>
                </div>
                
                <!-- Full Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Description</label>
                    <textarea name="description" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('description') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Detailed product information, specifications, materials, etc.</p>
                </div>
            </div>
        </div>

        <!-- Media Uploads -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-zinc-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Media</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Main Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors overflow-hidden relative group">
                            
                            <template x-if="mainPreview">
                                <div class="absolute inset-0 w-full h-full bg-white">
                                    <img :src="mainPreview" class="w-full h-full object-contain p-2">
                                    <button type="button" @click.prevent="clearMainImage()" class="absolute top-2 right-2 bg-white/90 hover:bg-red-500 hover:text-white text-red-500 rounded-full w-8 h-8 flex items-center justify-center transition-all shadow-md">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </template>

                            <div class="flex flex-col items-center justify-center pt-5 pb-6" x-show="!mainPreview">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3 group-hover:text-blue-500 transition-colors"></i>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload main image</span></p>
                            </div>
                            <input type="file" name="image" id="mainImageInput" class="hidden" accept="image/*" @change="previewMain" />
                        </label>
                    </div>
                </div>

                <!-- Gallery Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                    <div class="flex items-center justify-center w-full mb-3">
                        <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-images text-xl text-gray-400 mb-1 group-hover:text-blue-500 transition-colors"></i>
                                <p class="text-sm text-gray-500"><span class="font-semibold">Upload Multiple Images</span></p>
                            </div>
                            <input type="file" name="gallery[]" id="galleryInput" multiple class="hidden" accept="image/*" @change="previewGallery" />
                        </label>
                    </div>

                    <!-- Gallery Previews Grid -->
                    <div class="grid grid-cols-4 gap-2" x-show="galleryPreviews.length > 0">
                        <template x-for="(preview, index) in galleryPreviews" :key="index">
                            <div class="aspect-square rounded-lg border border-gray-200 overflow-hidden relative group bg-white shadow-sm">
                                <img :src="preview" class="w-full h-full object-contain p-1">
                                <button type="button" @click.prevent="removeGalleryPreview(index)" class="absolute top-1 right-1 bg-white hover:bg-red-500 hover:text-white text-red-500 rounded-full w-6 h-6 flex items-center justify-center transition-all shadow-md opacity-0 group-hover:opacity-100">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-zinc-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Status & Toggles</h2>
            <div class="flex gap-6">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" class="sr-only peer" checked>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-700">Active</span>
                </label>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_featured" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-700">Featured</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-600/30 transition-all active:scale-95 flex items-center gap-2 text-sm">
                <i class="fas fa-check"></i> Save Product
            </button>
        </div>
    </form>
</div>

<!-- FIXED ALPINE SCRIPT -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productImageManager', () => ({
            mainPreview: null,
            galleryFiles: [],     
            galleryPreviews: [],  

            // Main Image Logic
            previewMain(event) {
                const file = event.target.files[0];
                if (file) {
                    this.mainPreview = URL.createObjectURL(file);
                }
            },
            clearMainImage() {
                this.mainPreview = null;
                document.getElementById('mainImageInput').value = ''; 
            },

            // Gallery Logic (Appending & Deleting)
            previewGallery(event) {
                const newFiles = Array.from(event.target.files);
                const dataTransfer = new DataTransfer();

                // 1. Keep the old files
                this.galleryFiles.forEach(file => dataTransfer.items.add(file));

                // 2. Add the new files
                newFiles.forEach(file => {
                    dataTransfer.items.add(file);
                    this.galleryFiles.push(file);
                    this.galleryPreviews.push(URL.createObjectURL(file));
                });

                // 3. Update the hidden HTML input
                document.getElementById('galleryInput').files = dataTransfer.files;
            },
            
            removeGalleryPreview(index) {
                // 1. Remove from our arrays
                this.galleryFiles.splice(index, 1);
                this.galleryPreviews.splice(index, 1);

                // 2. Rebuild the file input
                const dataTransfer = new DataTransfer();
                this.galleryFiles.forEach(file => dataTransfer.items.add(file));
                document.getElementById('galleryInput').files = dataTransfer.files;
            }
        }));
    });
</script>
@endsection