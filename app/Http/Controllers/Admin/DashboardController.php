<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch stats for the admin dashboard
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $activeProducts = Product::where('is_active', true)->count();
        
        // You can add total orders here once the Order model is built
        // $totalOrders = Order::count();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'activeProducts'));
    }
}