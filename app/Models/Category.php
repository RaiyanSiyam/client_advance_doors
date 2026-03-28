<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'image', 
        'is_active',
        'parent_id' // Added to allow mass assignment
    ];

    // Get the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Get the sub-categories (children)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}