@extends('admin.layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto" x-data="{ 
    preview: null, 
    handleFile(event) { 
        const file = event.target.files[0]; 
        if (file) { this.preview = URL.createObjectURL(file); } 
    }, 
    clearImage() { 
        this.preview = null; 
        this.$refs.fileInput.value = ''; 
    } 
}">
    
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Category</h1>
        <p class="text-gray-600 text-sm mt-1">Add a new category to organize your product catalog.</p>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-zinc-500 hover:text-zinc-900 transition-colors flex items-center gap-2 text-sm font-semibold w-fit px-3 py-1.5 rounded-lg hover:bg-zinc-100 -ml-3">
            <i class="fas fa-arrow-left text-xs"></i> Back to Categories
        </a>
    </div>

    <!-- Error Messages -->
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

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="relative">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
            <div class="p-6 sm:p-8 space-y-8">
                
                <!-- Category Name -->
                <div>
                    <label class="block text-sm font-semibold text-zinc-800 mb-2">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Interior Doors" class="w-full border border-zinc-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-colors text-zinc-800 bg-zinc-50 focus:bg-white" required>
                    @error('name') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Category Image -->
                <div>
                    <label class="block text-sm font-semibold text-zinc-800 mb-2">Category Image</label>
                    
                    <div class="mt-2 flex justify-center rounded-xl border border-dashed border-zinc-300 px-6 py-8 bg-zinc-50 relative group hover:bg-zinc-100 transition-colors cursor-pointer" @click="$refs.fileInput.click()">
                        
                        <!-- Placeholder when no image is selected -->
                        <div class="text-center" x-show="!preview">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-white shadow-sm border border-zinc-200 mb-4 group-hover:scale-105 transition-transform">
                                <i class="fas fa-image text-zinc-400 text-xl"></i>
                            </div>
                            <div class="mt-4 flex text-sm leading-6 text-zinc-600 justify-center">
                                <span class="relative cursor-pointer rounded-md font-semibold text-zinc-900 focus-within:outline-none hover:text-zinc-700">
                                    <span>Upload a file</span>
                                    <input id="image" name="image" type="file" class="sr-only" x-ref="fileInput" @change="handleFile" accept="image/*">
                                </span>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-zinc-500">PNG, JPG, WEBP up to 2MB</p>
                        </div>

                        <!-- Preview when image is selected -->
                        <div x-show="preview" style="display: none;" class="relative w-full flex justify-center">
                            <img :src="preview" class="max-h-48 rounded-lg object-contain shadow-sm border border-zinc-200">
                            <button type="button" @click.stop="clearImage" class="absolute -top-3 -right-3 bg-white text-red-500 hover:text-red-600 shadow-md rounded-full w-8 h-8 flex items-center justify-center border border-zinc-100 hover:scale-110 transition-transform">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @error('image') <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Active Status -->
                <div class="border-t border-zinc-100 pt-6 mt-6">
                    <label class="flex items-start gap-4 p-4 rounded-xl border border-zinc-200 bg-zinc-50/50 cursor-pointer hover:bg-zinc-50 transition-colors group">
                        <div class="flex items-center h-6 mt-0.5">
                            <input type="checkbox" name="is_active" id="is_active" value="1" class="w-5 h-5 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900 transition-colors" {{ old('is_active', true) ? 'checked' : '' }}>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-zinc-800 group-hover:text-zinc-900 transition-colors">Active Category</span>
                            <span class="text-xs text-zinc-500 mt-0.5">Make this category visible on the storefront. Uncheck to hide it.</span>
                        </div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Sticky Footer -->
        <div class="flex justify-end gap-3 sticky bottom-4 bg-white/80 backdrop-blur-md p-4 mt-6 rounded-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border border-zinc-100 z-20">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 rounded-xl font-semibold text-zinc-600 hover:bg-zinc-100 transition-colors text-sm flex items-center">Cancel</a>
            <button type="submit" class="px-8 py-2.5 bg-zinc-900 text-white rounded-xl font-bold hover:bg-black shadow-lg shadow-zinc-900/20 transition-all active:scale-95 flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i> Create Category
            </button>
        </div>
    </form>
</div>
@endsection