@extends('admin.layouts.admin')

@section('content')

<!-- Script initialized at the top to ensure it loads before Alpine -->
<script>
    window.uploadManager = function() {
        return {
            mainPreview: null,
            removeMain: false, 
            galleryFiles: [],     
            galleryPreviews: [],  

            previewMain(event) {
                const file = event.target?.files[0];
                if (file) {
                    this.mainPreview = URL.createObjectURL(file);
                    this.removeMain = false;
                }
            },
            
            clearMainImage() {
                this.mainPreview = null;
                const input = document.getElementById('mainImageInput');
                if (input) input.value = ''; 
            },

            previewGallery(event) {
                const newFiles = Array.from(event.target?.files || []);
                if (newFiles.length === 0) return;

                const dataTransfer = new DataTransfer();

                // Keep existing files in the input
                this.galleryFiles.forEach(file => dataTransfer.items.add(file));

                // Add new files
                newFiles.forEach(file => {
                    dataTransfer.items.add(file);
                    this.galleryFiles.push(file);
                    this.galleryPreviews.push(URL.createObjectURL(file));
                });

                // Update input
                const input = document.getElementById('galleryInput');
                if (input) input.files = dataTransfer.files;
            },

            removeGalleryImage(index) {
                this.galleryFiles.splice(index, 1);
                this.galleryPreviews.splice(index, 1);

                const dataTransfer = new DataTransfer();
                this.galleryFiles.forEach(file => dataTransfer.items.add(file));

                const input = document.getElementById('galleryInput');
                if (input) input.files = dataTransfer.files;
            }
        }
    }
</script>

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
            
            <!-- Left Column: Main Details -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- General Info Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">General Information</h2>
                    
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                    </div>

                    @php
                        // Logic to pre-select correct Parent and Sub Category
                        $currentCatId = old('category_id', $product->category_id);
                        $currentCategory = $categories->firstWhere('id', $currentCatId);
                        
                        $parentCatId = '';
                        $subCatId = '';

                        if ($currentCategory) {
                            if ($currentCategory->parent_id) {
                                $parentCatId = $currentCategory->parent_id;
                                $subCatId = $currentCategory->id;
                            } else {
                                $parentCatId = $currentCategory->id;
                            }
                        }
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Parent Category -->
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Main Category <span class="text-red-500">*</span></label>
                            <select id="parentCategorySelect" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5 bg-white">
                                <option value="">-- Select Main Category --</option>
                                @foreach($categories->whereNull('parent_id') as $category)
                                    <option value="{{ $category->id }}" {{ $parentCatId == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sub Category -->
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Sub Category</label>
                            <select id="subCategorySelect" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5 bg-white">
                                <option value="">-- Select Sub Category --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Hidden actual category_id that gets submitted -->
                    <input type="hidden" name="category_id" id="finalCategoryId" value="{{ $currentCatId }}">

                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">SKU (Stock Keeping Unit)</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                    </div>
                </div>

                <!-- Pricing & Inventory Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Pricing & Inventory</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Regular Price (৳) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Sale Price (৳)</label>
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 mb-2">Stock Quantity</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-2.5">
                        </div>
                    </div>
                </div>

                <!-- Description Box -->
                <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Product Description</h2>
                    
                    <div>
                        <textarea name="description" rows="6" class="w-full rounded-xl border-zinc-300 focus:border-zinc-500 focus:ring-zinc-500 shadow-sm transition-colors px-4 py-3">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column: Media & Status -->
            <div class="space-y-8">
                
                <!-- Media Upload Box -->
                <div x-data="uploadManager()" class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800 border-b border-zinc-100 pb-3">Product Media</h2>
                    
                    <!-- Main Image -->
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Main Image</label>
                        
                        <!-- Hidden input to tell Controller to delete main image -->
                        <input type="hidden" name="remove_main_image" :value="removeMain ? '1' : '0'">

                        <div class="relative w-full aspect-square bg-zinc-50 rounded-xl border border-zinc-200 overflow-hidden group">
                            
                            <!-- Existing or No Image -->
                            <div x-show="!mainPreview" class="w-full h-full">
                                @if($product->image)
                                    <!-- Active existing image -->
                                    <div x-show="!removeMain" class="w-full h-full relative group">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" alt="Current Image" onerror="this.src='https://placehold.co/400x400?text=Missing+Image'">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button type="button" @click="removeMain = true" class="bg-red-500 text-white text-xs font-bold px-3 py-2 rounded flex items-center gap-2 shadow-lg hover:bg-red-600">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Marked for deletion -->
                                    <div x-show="removeMain" style="display: none;" class="w-full h-full flex flex-col items-center justify-center bg-red-50 text-red-500 border-2 border-dashed border-red-200">
                                        <i class="fas fa-trash-alt text-3xl mb-2"></i>
                                        <span class="text-sm font-bold">Marked for Deletion</span>
                                        <button type="button" @click="removeMain = false" class="mt-2 text-zinc-500 hover:text-zinc-800 underline text-xs">Undo</button>
                                    </div>
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-zinc-400">
                                        <i class="far fa-image text-3xl mb-2"></i>
                                        <span class="text-sm">No image</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- New image preview -->
                            <div x-show="mainPreview" style="display: none;" class="w-full h-full">
                                <img :src="mainPreview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 ring-4 ring-inset ring-blue-500 rounded-xl pointer-events-none"></div>
                                <button type="button" @click="clearMainImage()" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 shadow-md">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Main Image Input -->
                        <div class="mt-3 relative">
                            <input type="file" id="mainImageInput" name="image" accept="image/*" @change="previewMain" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 transition-all cursor-pointer">
                        </div>
                    </div>

                    <hr class="border-zinc-100">

                    <!-- FOOLPROOF ARRAY FLATTENER BLOCK -->
                    @php
                        $finalGallery = [];
                        $rawGallery = $product->gallery;
                        
                        if (!empty($rawGallery)) {
                            $parsed = $rawGallery;
                            
                            // 1. Unpack JSON multiple times in case it was double/triple stringified in DB
                            for ($i = 0; $i < 3; $i++) {
                                if (is_string($parsed)) {
                                    $attempt = json_decode($parsed, true);
                                    if (json_last_error() === JSON_ERROR_NONE && $attempt !== null) {
                                        $parsed = $attempt;
                                    }
                                }
                            }

                            // 2. Fallback: If it's STILL a broken array string (like '["img1", "img2"'), string manipulate it
                            if (is_string($parsed)) {
                                $stripped = str_replace(['[', ']', '"', "'", '\\', '{', '}'], '', $parsed);
                                $parsed = explode(',', $stripped);
                            }

                            // 3. Ensure we have an actual PHP array to work with
                            if (!is_array($parsed)) {
                                $parsed = [$parsed];
                            }

                            // 4. CRITICAL FIX: Flatten multidimensional arrays. 
                            // This stops the "Array to string conversion" error if the DB returns nested arrays [["img"]]
                            $flatPaths = [];
                            array_walk_recursive($parsed, function($item) use (&$flatPaths) {
                                $flatPaths[] = $item;
                            });

                            // 5. Clean up each path and guarantee it is a string
                            foreach ($flatPaths as $path) {
                                if (is_scalar($path)) { // Ensure it's not somehow still an object/array
                                    $cleanPath = trim((string)$path);
                                    if (!empty($cleanPath) && $cleanPath !== 'null') {
                                        $cleanPath = str_replace('\/', '/', $cleanPath);
                                        $finalGallery[] = ltrim($cleanPath, '/');
                                    }
                                }
                            }
                            
                            // Remove any accidental duplicates
                            $finalGallery = array_unique($finalGallery);
                        }
                    @endphp

                    <!-- Gallery Images Section -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-semibold text-zinc-700">Gallery Images</label>
                            <span class="text-xs font-bold text-zinc-400 bg-zinc-100 px-2 py-0.5 rounded">{{ count($finalGallery) }} Found</span>
                        </div>
                        <p class="text-xs text-zinc-500 mb-3 leading-relaxed">Uploading new files will <strong>add</strong> to the gallery. Select existing images to delete them.</p>

                        <!-- Render Existing Images (If any exist in DB) -->
                        @if(count($finalGallery) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4">
                                @foreach($finalGallery as $img)
                                    <div class="aspect-square relative rounded-xl border border-zinc-200 overflow-hidden group bg-zinc-50 flex items-center justify-center">
                                        <!-- Error fallback changed to red broken link placeholder -->
                                        <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover" alt="Gallery Image" 
                                             onerror="this.onerror=null; this.src='https://placehold.co/400x400/ef4444/ffffff?text=Broken+Link';">
                                        
                                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity backdrop-blur-sm">
                                            <label class="text-white text-sm cursor-pointer font-bold bg-red-600 px-3 py-1.5 rounded-lg shadow-sm text-center hover:bg-red-700 flex items-center gap-2">
                                                <!-- The input value is now 100% guaranteed to be a flat string -->
                                                <input type="checkbox" name="remove_gallery[]" value="{{ $img }}" class="rounded text-red-600 focus:ring-red-500"> Delete
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-zinc-50 border border-zinc-200 border-dashed rounded-xl p-4 text-center text-sm text-zinc-500 mb-4">
                                No existing gallery images found.
                            </div>
                        @endif

                        <!-- Previews for NEWly added Gallery Images -->
                        <div x-show="galleryPreviews.length > 0" style="display: none;" class="grid grid-cols-3 gap-2 mb-2 pt-2 border-t border-zinc-100">
                            <template x-for="(preview, index) in galleryPreviews" :key="index">
                                <div class="aspect-square relative rounded-lg border-2 border-blue-400 shadow-sm overflow-hidden group">
                                    <img :src="preview" class="w-full h-full object-cover">
                                    <button type="button" @click="removeGalleryImage(index)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 shadow-md">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <!-- Gallery File Input -->
                        <div class="mt-3 relative">
                            <input type="file" id="galleryInput" name="gallery[]" multiple accept="image/*" @change="previewGallery" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 transition-all cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Status Box -->
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

<!-- Parent/Sub Category Dynamic Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allCategories = @json($categories);
        
        const parentSelect = document.getElementById('parentCategorySelect');
        const subSelect = document.getElementById('subCategorySelect');
        const finalCategoryId = document.getElementById('finalCategoryId');
        
        const initialSubCatId = '{{ $subCatId }}';

        function populateSubCategories(parentId, selectedSubId = null) {
            subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';
            
            if (!parentId) {
                subSelect.disabled = true;
                return;
            }

            const subs = allCategories.filter(c => c.parent_id == parentId);
            
            if (subs.length > 0) {
                subSelect.disabled = false;
                subs.forEach(sub => {
                    const opt = document.createElement('option');
                    opt.value = sub.id;
                    opt.textContent = sub.name;
                    if (sub.id == selectedSubId) {
                        opt.selected = true;
                    }
                    subSelect.appendChild(opt);
                });
            } else {
                subSelect.disabled = true;
            }
        }

        function updateFinalCategory() {
            if (subSelect.value) {
                finalCategoryId.value = subSelect.value;
            } else if (parentSelect.value) {
                finalCategoryId.value = parentSelect.value;
            } else {
                finalCategoryId.value = '';
            }
        }

        // Initialize on load
        populateSubCategories(parentSelect.value, initialSubCatId);

        // Listeners
        parentSelect.addEventListener('change', function() {
            populateSubCategories(this.value);
            updateFinalCategory();
        });

        subSelect.addEventListener('change', updateFinalCategory);
    });
</script>

@endsection