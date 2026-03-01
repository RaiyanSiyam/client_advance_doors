@extends('admin.layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Category: {{ $category->name }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:underline">&larr; Back to Categories</a>
    </div>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow-md rounded-lg max-w-2xl">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Category Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Category Image</label>
            @if($category->image)
                <div class="mb-3">
                    <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                    <img src="{{ asset('storage/' . $category->image) }}" class="h-24 w-24 object-cover rounded shadow">
                </div>
            @endif
            <input type="file" name="image" class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-50">
            <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current image.</p>
            @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" name="is_active" id="is_active" class="h-5 w-5 text-blue-600 border-gray-300 rounded cursor-pointer" {{ $category->is_active ? 'checked' : '' }}>
            <label for="is_active" class="ml-2 block text-gray-700 font-bold cursor-pointer">Set as Active</label>
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-bold shadow">
            Update Category
        </button>
    </form>
</div>
@endsection