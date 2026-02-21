<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // The fields that are allowed to be mass-assigned (e.g., when creating a category)
    protected $fillable = [
        'name', 
        'slug', 
        'image', 
        'is_active'
    ];

    /**
     * Relationship: A Category has many Products.
     * This allows you to call $category->products to get all products in that category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}