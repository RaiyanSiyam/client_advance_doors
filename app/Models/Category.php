<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Updated to match your exact database columns
    protected $fillable = [
        'name',
        'slug',
        'image',
        'is_active'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}