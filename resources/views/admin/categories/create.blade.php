@extends('admin.layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Add New Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:underline">&larr; Back to Categories</a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow-md rounded-lg max-w-2xl">
        @csrf

        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Category Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-bold mb-2">Category Image</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-50">
            @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" name="is_active" id="is_active" class="h-5 w-5 text-blue-600 border-gray-300 rounded cursor-pointer" checked>
            <label for="is_active" class="ml-2 block text-gray-700 font-bold cursor-pointer">Set as Active</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition font-bold shadow">
            Save Category
        </button>
    </form>
</div>
@endsection