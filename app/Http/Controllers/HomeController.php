<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        // Fetch active categories
        $categories = Category::where('is_active', true)->get();

        // Fetch featured products (Best Sellers)
        $featuredProducts = Product::with('category')
                                   ->where('is_active', true)
                                   ->where('is_featured', true)
                                   ->take(8) // Limit to 8 items
                                   ->get();

        return view('pages.home', compact('categories', 'featuredProducts'));
    }
}