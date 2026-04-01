<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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