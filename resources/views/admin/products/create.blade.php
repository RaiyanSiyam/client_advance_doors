@extends('admin.layouts.admin')

@section('content')

<!-- Bulletproof script for Image Upload Preview -->
<script>
    window.uploadManager = function() {
        return {
            mainPreview: null,
            galleryFiles: [],     
            galleryPreviews: [],  

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
            },

            previewGallery(event) {
                const newFiles = Array.from(event.target?.files || []);
                if (newFiles.length === 0) return;

                const dataTransfer = new DataTransfer();

                this.galleryFiles.forEach(file => dataTransfer.items.add(file));

                newFiles.forEach(file => {
                    dataTransfer.items.add(file);
                    this.galleryFiles.push(file);
                    this.galleryPreviews.push(URL.createObjectURL(file));
                });

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
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Add New Product</h1>
        <p class="text-gray-600 text-sm mt-1">Create a new product for your store catalog.</p>
    </div>

    <!-- MAIN FORM -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" x-data="uploadManager()">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Box -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">General Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all" placeholder="e.g. Premium Solid Wood Door">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- DYNAMIC CATEGORY DROPDOWNS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            
                            <!-- Hidden input that actually submits to the database -->
                            <input type="hidden" name="category_id" id="final_category_id" value="{{ old('category_id') }}" required>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Main Category <span class="text-red-500">*</span></label>
                                <select id="parent_category_select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white">
                                    <option value="">-- Select Main Category --</option>
                                    <!-- Only show categories that have NO parent -->
                                    @foreach($categories->whereNull('parent_id') as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sub Category</label>
                                <select id="sub_category_select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white disabled:bg-gray-100 disabled:text-gray-400" disabled>
                                    <option value="">-- Select Sub Category --</option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Optional. Requires Main Category.</p>
                            </div>
                        </div>
                        @error('category_id') <span class="text-red-500 text-xs mt-1">Please select a valid category.</span> @enderror
                    </div>
                </div>

                <!-- Pricing & Inventory Box -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Pricing & Inventory</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Price ($) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all" placeholder="0.00">
                            @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Compare Price ($)</label>
                            <input type="number" step="0.01" name="old_price" value="{{ old('old_price') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all" placeholder="0.00">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 10) }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Full Description Box -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Detailed Description</h2>
                    <div>
                        <textarea name="description" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column: Images & Status -->
            <div class="space-y-6">
                <!-- Status Box -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Visibility Status</h2>
                    <div class="space-y-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Active (Visible in Store)</span>
                        </label>

                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Featured Product</span>
                        </label>
                    </div>
                </div>

                <!-- Main Image Upload -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Main Product Image</h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors relative cursor-pointer" onclick="document.getElementById('mainImageInput').click()">
                        <template x-if="!mainPreview">
                            <div class="py-6">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Click to upload image</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                        </template>
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
                    @error('image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Sticky Footer for Save Button -->
        <div class="flex justify-end gap-3 sticky bottom-6 bg-white/90 backdrop-blur-md p-4 mt-8 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-gray-100 z-20">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-gray-600 hover:bg-gray-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-gray-900/20 transition-all flex items-center gap-2">
                <i class="fas fa-save text-sm"></i> Create Product
            </button>
        </div>
    </form>
</div>

<!-- Category Dropdown Logic -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allCategories = @json($categories ?? []);
        const parentSelect = document.getElementById('parent_category_select');
        const subSelect = document.getElementById('sub_category_select');
        const finalCategoryId = document.getElementById('final_category_id');

        // Function to update the hidden input that gets sent to Laravel
        function updateFinalCategory() {
            if (subSelect.value) {
                finalCategoryId.value = subSelect.value;
            } else if (parentSelect.value) {
                finalCategoryId.value = parentSelect.value;
            } else {
                finalCategoryId.value = '';
            }
        }

        // When the Main Category changes
        parentSelect.addEventListener('change', function() {
            const parentId = this.value;
            
            // Clear current subcategories
            subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';
            subSelect.value = '';
            
            if (parentId) {
                // Find subcategories belonging to this parent
                const subs = allCategories.filter(c => c.parent_id == parentId);
                
                if (subs.length > 0) {
                    subSelect.disabled = false;
                    subs.forEach(sub => {
                        const opt = document.createElement('option');
                        opt.value = sub.id;
                        opt.textContent = sub.name;
                        subSelect.appendChild(opt);
                    });
                } else {
                    // No subcategories exist for this parent
                    subSelect.disabled = true;
                }
            } else {
                subSelect.disabled = true;
            }
            
            updateFinalCategory();
        });

        // When Sub Category changes
        subSelect.addEventListener('change', updateFinalCategory);
    });
</script>
@endsection