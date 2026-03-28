<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontCategoryController extends Controller
{
    public function show($slug)
    {
        // Use first() instead of firstOrFail() temporarily so we can debug
        $category = Category::where('slug', $slug)->first();

        // If the category is null, it means the slug isn't in your database
        if (!$category) {
            dd("DEBUG ERROR: No category found in the database with the slug: '" . $slug . "'. Please check your Admin panel to make sure this category exists and is spelled correctly.");
        }

        // If we make it here, check if the view exists
        if (!view()->exists('pages.category')) {
            dd("DEBUG ERROR: The database found the category, but the view file is missing! Please create 'resources/views/pages/category.blade.php'");
        }

        return view('pages.category', compact('category'));
    }
}