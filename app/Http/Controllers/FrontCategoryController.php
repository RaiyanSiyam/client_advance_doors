<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontCategoryController extends Controller
{
    public function show($slug)
    {
        // Eager load children AND parent to check for subcategories and build breadcrumbs
        $category = Category::with(['children', 'parent'])->where('slug', $slug)->firstOrFail();

        // Check if this category has subcategories
        if ($category->children->count() > 0) {
            $subcategories = $category->children;
            return view('pages.category', compact('category', 'subcategories'));
        }

        // If no subcategories exist, fetch products for this category and apply filters
        $query = Product::where('category_id', $category->id)
                        ->where('is_active', 1);

        // Handle the sorting logic
        $sort = request('sort', 'latest');
        if ($sort === 'price_low') {
            // COALESCE checks if sale_price exists, if not it uses regular price
            $query->orderByRaw('COALESCE(sale_price, price) ASC');
        } elseif ($sort === 'price_high') {
            $query->orderByRaw('COALESCE(sale_price, price) DESC');
        } else {
            $query->latest(); // Default: Recently added
        }

        // Paginate and append the current sort query to the page links
        $products = $query->paginate(12)->appends(request()->query());

        return view('pages.category', compact('category', 'products'));
    }
}