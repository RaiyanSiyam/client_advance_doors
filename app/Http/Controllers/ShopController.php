<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    // List all products with optional category filtering
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        // Filter by category if requested via URL (e.g., /shop?category=solid-wood-doors)
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        // Paginate results (12 products per page)
        $products = $query->latest()->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('pages.shop', compact('products', 'categories'));
    }
}