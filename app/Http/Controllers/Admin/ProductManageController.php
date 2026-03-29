<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductManageController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        // 1. Handle Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // 2. Handle Category Filter (INCLUDING Sub-categories)
        if ($request->filled('category_id')) {
            $categoryId = $request->category_id;
            
            // Check if this category has subcategories
            $childCategoryIds = Category::where('parent_id', $categoryId)->pluck('id')->toArray();
            
            if (!empty($childCategoryIds)) {
                // If it's a Parent Category, get products from it AND all its subcategories
                $childCategoryIds[] = $categoryId;
                $query->whereIn('category_id', $childCategoryIds);
            } else {
                // If it's a Sub Category, just get its specific products
                $query->where('category_id', $categoryId);
            }
        }

        // Paginate and append search/category queries to the pagination links
        $products = $query->paginate(10)->appends($request->all());
        
        $categories = Category::all(); 
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image', 'gallery']);
        
        // Generate a UNIQUE slug
        $originalSlug = Str::slug($request->name);
        $slug = $originalSlug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        $data['slug'] = $slug;
        
        $data['sku'] = $request->sku; 
        $data['sale_price'] = $request->sale_price;

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths;
        } else {
            $data['gallery'] = [];
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image', 'gallery', 'remove_gallery']);
        
        // Generate a UNIQUE slug (ignore the current product's slug)
        $originalSlug = Str::slug($request->name);
        $slug = $originalSlug;
        $count = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        $data['slug'] = $slug;
        
        $data['sku'] = $request->sku;
        $data['sale_price'] = $request->sale_price;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        
        $currentGallery = is_string($product->gallery) ? json_decode($product->gallery, true) : $product->gallery;
        $currentGallery = is_array($currentGallery) ? $currentGallery : [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $currentGallery[] = $file->store('products/gallery', 'public');
            }
            $data['gallery'] = $currentGallery;
        }

        if ($request->has('remove_gallery')) {
            foreach ($request->remove_gallery as $fileToRemove) {
                Storage::disk('public')->delete($fileToRemove);
                $currentGallery = array_filter($currentGallery, fn($val) => $val !== $fileToRemove);
            }
            $data['gallery'] = array_values($currentGallery); 
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $gallery = is_string($product->gallery) ? json_decode($product->gallery, true) : $product->gallery;
        if (is_array($gallery)) {
            foreach ($gallery as $file) {
                Storage::disk('public')->delete($file);
            }
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}