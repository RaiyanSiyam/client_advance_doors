<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Handles the main /product page and the Search Bar
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', 1);

        // If the user typed something in the search bar, filter the products!
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Get the products and remember the search query for pagination links
        $products = $query->paginate(12)->appends($request->all());
        
        // Since the shop page was deleted, we will reuse your beautiful pages.category view!
        // We create a "virtual" category object so the view's header text works perfectly without crashing.
        $category = new Category();
        $category->name = $request->filled('search') ? 'Search Results' : 'All Products';
        $category->description = $request->filled('search') ? 'Showing matches for: "' . $request->search . '"' : 'Browse our complete catalog.';
        $category->slug = 'all'; // Fallback slug to prevent routing errors

        return view('pages.category', compact('products', 'category'));
    }

    // 2. Handles single product viewing (Untouched)
    public function show($slug)
    {
        // 1. Fetch the product by slug. 
        // We eager load 'category' and 'category.parent' so the breadcrumbs work perfectly!
        $product = Product::with(['category', 'category.parent'])
                          ->where('slug', $slug)
                          ->where('is_active', 1)
                          ->firstOrFail();

        // 2. Fetch Related Products
        // Eager load 'category' to prevent N+1 queries in the related products grid
        $relatedProducts = Product::with('category')
                                  ->where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->where('is_active', 1)
                                  ->inRandomOrder() // Mixes them up so it looks fresh
                                  ->take(4)         // Limits it to 4 products (1 row)
                                  ->get();

        // 3. Return the new product_card view!
        return view('pages.product_card', compact('product', 'relatedProducts'));
    }
}