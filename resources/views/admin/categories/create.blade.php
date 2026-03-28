@extends('layouts.admin') {{-- Change this to your actual admin layout name if different --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Add New Category</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Category Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" placeholder="e.g. Solid Wood">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- PARENT CATEGORY DROPDOWN -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Parent Category (Optional)</label>
                <select name="parent_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none bg-white">
                    <option value="">-- None (Make this a Top-Level Category) --</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-slate-500 mt-1">Select a parent if this is a sub-category.</p>
                @error('parent_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Category Image</label>
                <input type="file" name="image" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-amber-500 border-slate-300 rounded focus:ring-amber-500">
                <label for="is_active" class="ml-2 text-sm text-slate-700">Category is Active</label>
            </div>

            <button type="submit" class="bg-slate-900 text-white px-6 py-2 rounded-lg hover:bg-slate-800 transition">
                Save Category
            </button>
        </form>
    </div>
</div>
@endsection