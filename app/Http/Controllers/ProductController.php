<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
 public function index(\Illuminate\Http\Request $request)
    {
        // 1. Get ALL categories with their product counts (needed for the folder grid)
        $categories = \App\Models\Category::withCount('products')->get();

        // 2. Prepare the product query
        $query = \App\Models\Product::with('category')->latest();

        // 3. Filter by Category if clicked on a folder
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. Filter by Search Query (Searches Name or SKU code)
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                  ->orWhere('sku', 'LIKE', $searchTerm)
                  ->orWhere('description', 'LIKE', $searchTerm); 
            });
        }

        // 5. Paginate the results
        $products = $query->paginate(15);

        // 6. Pass BOTH $products and $categories to the view
        return view('admin.products.index', compact('products', 'categories'));
    }
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // ... (Keep existing store logic from previous response)
    }

    // Add this destroy method to handle deletions!
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}