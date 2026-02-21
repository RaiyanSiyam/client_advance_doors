<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Allow all fields to be filled automatically except the primary ID
    protected $guarded = ['id'];

    // Automatically convert these database columns into the correct PHP data types
    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    /**
     * Relationship: A Product belongs to one Category.
     * This allows you to call $product->category->name to get the category name.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Helper Method: Get the currently active price.
     * If there is a sale price, it returns the sale price. Otherwise, it returns the regular price.
     * You can use this in your views like this: $product->active_price
     */
    public function getActivePriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }
}