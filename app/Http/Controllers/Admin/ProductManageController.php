<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductManageController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'sku' => 'nullable|string|max:100',
            'category_id' => 'required',
            'stock_quantity' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('_token', 'image', 'gallery');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');
        
        // 1. Handle Main Image Upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        // 2. Handle Gallery Uploads (Save as JSON array)
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('products/gallery', 'public');
                $galleryPaths[] = '/storage/' . $path;
            }
            $data['gallery'] = json_encode($galleryPaths);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    // Show Edit Form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'sku' => 'nullable|string|max:100',
            'category_id' => 'required',
            'stock_quantity' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('_token', '_method', 'image', 'gallery');
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Handle Main Image Upload
        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        // Handle Gallery Uploads
        if ($request->hasFile('gallery')) {
            // Delete old gallery images to save space
            if ($product->gallery) {
                $oldGallery = json_decode($product->gallery, true);
                if (is_array($oldGallery)) {
                    foreach ($oldGallery as $oldImage) {
                        if (!str_starts_with($oldImage, 'http')) {
                            Storage::disk('public')->delete(str_replace('/storage/', '', $oldImage));
                        }
                    }
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('products/gallery', 'public');
                $galleryPaths[] = '/storage/' . $path;
            }
            $data['gallery'] = json_encode($galleryPaths);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete main image
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }

        // Delete gallery files
        if ($product->gallery) {
            $gallery = json_decode($product->gallery, true);
            if (is_array($gallery)) {
                foreach ($gallery as $imagePath) {
                    if (!str_starts_with($imagePath, 'http')) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', $imagePath));
                    }
                }
            }
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}