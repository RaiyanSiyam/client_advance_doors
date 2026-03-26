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
    /**
     * Display a listing of the products.
     */
        public function index(Request $request)
    {
        // 1. Get ALL categories with their product counts 
        $categories = Category::withCount('products')->get();

        // 2. Prepare the product query
        $query = Product::with('category')->latest();

        // 3. Filter by Category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. Filter by Search Query (Case-insensitive fix for small/capital letters)
        if ($request->filled('search')) {
            $searchTerm = '%' . strtolower($request->search) . '%';
            
            // Using LOWER() makes it universally case-insensitive across all databases
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', [$searchTerm])
                  ->orWhereRaw('LOWER(sku) LIKE ?', [$searchTerm])
                  ->orWhereRaw('LOWER(description) LIKE ?', [$searchTerm]); 
            });
        }

        // 5. Paginate the results (withQueryString keeps your search/filters active on page 2, 3, etc)
        $products = $query->paginate(15)->withQueryString();

        // 6. Pass BOTH $products and $categories to the view
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image', 'gallery', '_token']);
        
        // Generate a unique slug based on the product name
        $data['slug'] = Str::slug($request->name) . '-' . uniqid();
        
        // Handle Booleans for checkboxes
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // 1. Handle Main Image Upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // 2. Handle Multiple Gallery Images Upload
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('products/gallery', 'public');
            }
        }
        $data['gallery'] = json_encode($galleryPaths);

        // Save Product
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image', 'gallery', 'existing_gallery', '_token', '_method']);
        
        // Handle Booleans for checkboxes (unchecked checkboxes aren't sent in the request)
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // --- 1. HANDLE MAIN IMAGE ---
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // --- 2. HANDLE GALLERY IMAGES ---
        
        // Get the gallery array currently saved in the database
        $currentGallery = json_decode($product->gallery, true) ?? [];
        
        // Get the array of paths the user decided to KEEP from the frontend
        $keptGallery = $request->input('existing_gallery', []);

        // Find images that exist in DB but were REMOVED by the user
        $imagesToDelete = array_diff($currentGallery, $keptGallery);
        
        // Delete physically discarded images from storage
        foreach ($imagesToDelete as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        // Initialize final gallery array with the kept images
        $finalGallery = $keptGallery;

        // Upload and Append newly selected gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $finalGallery[] = $image->store('products/gallery', 'public');
            }
        }

        // Save the updated gallery array back to JSON
        $data['gallery'] = json_encode(array_values($finalGallery));

        // Update Product
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // 1. Delete Main Image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        // 2. Delete All Gallery Images
        $galleryImages = json_decode($product->gallery, true) ?? [];
        foreach ($galleryImages as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }
        
        // 3. Delete the Product
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}