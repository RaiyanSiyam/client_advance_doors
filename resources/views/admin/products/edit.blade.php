@extends('admin.layouts.admin')

@section('content')

<!-- Bulletproof script for Image Upload Preview -->
<script>
    window.uploadManager = function() {
        return {
            mainPreview: null,
            previewMain(event) {
                const file = event.target?.files[0];
                if (file) {
                    this.mainPreview = URL.createObjectURL(file);
                }
            },
            clearMainImage() {
                this.mainPreview = null;
                const input = document.getElementById('mainImageInput');
                if (input) input.value = ''; 
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
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900 bg-white border border-gray-200 hover:bg-gray-50 font-semibold px-4 py-2 rounded-xl transition-all shadow-sm text-sm flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i> Back to Catalog
            </a>
            <a href="{{ route('product.show', $product->slug ?? '#') }}" target="_blank" class="text-blue-600 hover:text-blue-700 bg-blue-50 border border-blue-100 font-semibold px-4 py-2 rounded-xl transition-all shadow-sm text-sm flex items-center gap-2">
                View on Store <i class="fas fa-external-link-alt text-xs"></i>
            </a>
        </div>
    </div>

    @php
        // Figure out the current category hierarchy to pre-fill the dropdowns
        $currentCategoryId = old('category_id', $product->category_id);
        $currentCat = collect($categories)->firstWhere('id', $currentCategoryId);
        
        $isSubCategory = $currentCat && $currentCat->parent_id !== null;
        $currentParentId = $isSubCategory ? $currentCat->parent_id : ($currentCat->id ?? '');
        $currentSubId = $isSubCategory ? $currentCat->id : '';
    @endphp

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" x-data="uploadManager()">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">General Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- DYNAMIC CATEGORY DROPDOWNS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            
                            <!-- Hidden input -->
                            <input type="hidden" name="category_id" id="final_category_id" value="{{ $currentCategoryId }}" required>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Main Category <span class="text-red-500">*</span></label>
                                <select id="parent_category_select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white">
                                    <option value="">-- Select Main Category --</option>
                                    @foreach($categories->whereNull('parent_id') as $category)
                                        <option value="{{ $category->id }}" {{ $currentParentId == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sub Category</label>
                                <select id="sub_category_select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white disabled:bg-gray-100 disabled:text-gray-400" disabled>
                                    <option value="">-- Select Sub Category --</option>
                                </select>
                            </div>
                        </div>
                        @error('category_id') <span class="text-red-500 text-xs mt-1">Please select a valid category.</span> @enderror
                    </div>
                </div>

                <!-- Pricing -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Pricing & Inventory</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Price ($) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Compare Price ($)</label>
                            <input type="number" step="0.01" name="old_price" value="{{ old('old_price', $product->old_price) }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Detailed Description</h2>
                    <textarea name="description" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Status -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Visibility Status</h2>
                    <div class="space-y-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Active (Visible in Store)</span>
                        </label>

                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Featured Product</span>
                        </label>
                    </div>
                </div>

                <!-- Main Image -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Main Product Image</h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors relative cursor-pointer" onclick="document.getElementById('mainImageInput').click()">
                        
                        <!-- Shows Existing Image if no new file is selected -->
                        <template x-if="!mainPreview">
                            <div>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="max-h-48 mx-auto rounded-lg shadow-sm object-contain mb-3">
                                    <p class="text-xs text-gray-500 font-medium">Click to upload a replacement</p>
                                @else
                                    <div class="py-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600 font-medium">Click to upload image</p>
                                    </div>
                                @endif
                            </div>
                        </template>

                        <!-- Shows New Preview Image -->
                        <template x-if="mainPreview">
                            <div class="relative">
                                <img :src="mainPreview" class="max-h-48 mx-auto rounded-lg shadow-sm object-contain">
                                <button type="button" @click.stop="clearMainImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 shadow-md">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                    <input type="file" name="image" id="mainImageInput" class="hidden" accept="image/*" @change="previewMain">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 sticky bottom-6 bg-white/90 backdrop-blur-md p-4 mt-8 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-gray-100 z-20">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-gray-600 hover:bg-gray-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-gray-900/20 transition-all flex items-center gap-2">
                <i class="fas fa-save text-sm"></i> Update Product
            </button>
        </div>
    </form>
</div>

<!-- Dynamic Pre-fill Logic -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allCategories = @json($categories ?? []);
        const parentSelect = document.getElementById('parent_category_select');
        const subSelect = document.getElementById('sub_category_select');
        const finalCategoryId = document.getElementById('final_category_id');
        
        // Laravel injected IDs
        const initialParentId = "{{ $currentParentId }}";
        const initialSubId = "{{ $currentSubId }}";

        function updateFinalCategory() {
            if (subSelect.value) {
                finalCategoryId.value = subSelect.value;
            } else if (parentSelect.value) {
                finalCategoryId.value = parentSelect.value;
            } else {
                finalCategoryId.value = '';
            }
        }

        function populateSubCategories(parentId, preSelectId = null) {
            subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';
            subSelect.value = '';
            
            if (parentId) {
                const subs = allCategories.filter(c => c.parent_id == parentId);
                if (subs.length > 0) {
                    subSelect.disabled = false;
                    subs.forEach(sub => {
                        const opt = document.createElement('option');
                        opt.value = sub.id;
                        opt.textContent = sub.name;
                        // Auto-select if requested
                        if (sub.id == preSelectId) opt.selected = true;
                        subSelect.appendChild(opt);
                    });
                } else {
                    subSelect.disabled = true;
                }
            } else {
                subSelect.disabled = true;
            }
        }

        // Initialize on page load if a parent is selected
        if (initialParentId) {
            populateSubCategories(initialParentId, initialSubId);
        }

        // Handle manual changes
        parentSelect.addEventListener('change', function() {
            populateSubCategories(this.value);
            updateFinalCategory();
        });

        subSelect.addEventListener('change', updateFinalCategory);
    });
</script>
@endsection