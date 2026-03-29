@extends('admin.layouts.admin')

@section('content')

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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" x-data="uploadManager()">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Box -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">General Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <input type="hidden" name="category_id" id="final_category_id" value="{{ old('category_id') }}" required>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Main Category <span class="text-red-500">*</span></label>
                                <select id="parent_category_select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none bg-white">
                                    <option value="">-- Select Main Category --</option>
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UPDATED PRICING TEXT -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Pricing & Inventory</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Regular Price (৳) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all" placeholder="Actual selling price">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Sale Price (৳)</label>
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all" placeholder="Crossed-out price">
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
                    <textarea name="description" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-red-500 outline-none transition-all">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Visibility Status</h2>
                    <div class="space-y-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-green-500 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Active</span>
                        </label>
                        <br>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-yellow-500 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Featured</span>
                        </label>
                    </div>
                </div>

                <!-- Main Image Upload -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Main Image <span class="text-red-500">*</span></h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors relative cursor-pointer" onclick="document.getElementById('mainImageInput').click()">
                        <template x-if="!mainPreview">
                            <div class="py-6">
                                <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 font-medium">Click to upload main image</p>
                            </div>
                        </template>
                        <template x-if="mainPreview">
                            <div class="relative">
                                <img :src="mainPreview" class="max-h-48 mx-auto rounded-lg shadow-sm object-contain">
                                <button type="button" @click.stop="clearMainImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 shadow-md"><i class="fas fa-times text-sm"></i></button>
                            </div>
                        </template>
                    </div>
                    <input type="file" name="image" id="mainImageInput" class="hidden" accept="image/*" @change="previewMain" required>
                </div>

                <!-- GALLERY IMAGE UPLOAD -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Product Gallery</h2>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer mb-4" onclick="document.getElementById('galleryInput').click()">
                        <i class="fas fa-images text-2xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600 font-medium">Click to add multiple images</p>
                    </div>
                    
                    <input type="file" name="gallery[]" id="galleryInput" class="hidden" accept="image/*" multiple @change="previewGallery">

                    <!-- Gallery Previews -->
                    <div class="grid grid-cols-3 gap-2" x-show="galleryPreviews.length > 0">
                        <template x-for="(preview, index) in galleryPreviews" :key="index">
                            <div class="relative group">
                                <img :src="preview" class="h-20 w-full object-cover rounded-lg shadow-sm border border-gray-200">
                                <button type="button" @click="removeGalleryImage(index)" class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 shadow-md opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-end gap-3 sticky bottom-6 bg-white/90 backdrop-blur-md p-4 mt-8 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-gray-100 z-20">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-gray-600 hover:bg-gray-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-gray-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-gray-900/20 transition-all flex items-center gap-2">
                <i class="fas fa-save text-sm"></i> Create Product
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allCategories = @json($categories ?? []);
        const parentSelect = document.getElementById('parent_category_select');
        const subSelect = document.getElementById('sub_category_select');
        const finalCategoryId = document.getElementById('final_category_id');

        function updateFinalCategory() {
            if (subSelect.value) finalCategoryId.value = subSelect.value;
            else if (parentSelect.value) finalCategoryId.value = parentSelect.value;
            else finalCategoryId.value = '';
        }

        parentSelect.addEventListener('change', function() {
            const parentId = this.value;
            subSelect.innerHTML = '<option value="">-- Select Sub Category --</option>';
            subSelect.value = '';
            
            if (parentId) {
                const subs = allCategories.filter(c => c.parent_id == parentId);
                if (subs.length > 0) {
                    subSelect.disabled = false;
                    subs.forEach(sub => {
                        const opt = document.createElement('option');
                        opt.value = sub.id; opt.textContent = sub.name;
                        subSelect.appendChild(opt);
                    });
                } else {
                    subSelect.disabled = true;
                }
            } else { subSelect.disabled = true; }
            updateFinalCategory();
        });
        subSelect.addEventListener('change', updateFinalCategory);
    });
</script>
@endsection