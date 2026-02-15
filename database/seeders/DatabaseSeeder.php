<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Categories
        $categories = [
            ['name' => 'Solid Wood Doors', 'image' => 'door_icon.png'],
            ['name' => 'Glass Doors', 'image' => 'glass_icon.png'],
            ['name' => 'Living Room', 'image' => 'sofa_icon.png'],
            ['name' => 'Bedroom Sets', 'image' => 'bed_icon.png'],
            ['name' => 'Dining', 'image' => 'dining_icon.png'],
            ['name' => 'Office', 'image' => 'office_icon.png'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'image' => $cat['image'],
                'is_active' => true,
            ]);
        }

        // 2. Create Products (Doors)
        Product::create([
            'category_id' => 1, // Solid Wood Doors
            'name' => 'Mahogany Carved Door',
            'slug' => 'mahogany-carved-door',
            'sku' => 'DOOR-001',
            'short_description' => 'Premium mahogany door with hand carving.',
            'description' => '<p>Full HTML description of the door...</p>',
            'price' => 15000.00,
            'sale_price' => 12500.00,
            'image' => 'https://images.unsplash.com/photo-1517705600643-98fe9ccf3624?auto=format&fit=crop&w=500&q=80',
            'stock_quantity' => 50,
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Teak Main Entrance Door',
            'slug' => 'teak-main-entrance',
            'sku' => 'DOOR-002',
            'short_description' => 'Solid teak wood double door for main entrance.',
            'price' => 25000.00,
            'image' => 'https://images.unsplash.com/photo-1506377295352-e3154d43ea9e?auto=format&fit=crop&w=500&q=80',
            'is_featured' => true,
        ]);

        // 3. Create Products (Furniture)
        Product::create([
            'category_id' => 3, // Living Room
            'name' => 'Velvet Green Sofa',
            'slug' => 'velvet-green-sofa',
            'sku' => 'SOFA-001',
            'short_description' => 'Luxury 3-seater velvet sofa.',
            'price' => 45000.00,
            'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=500&q=80',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => 4, // Bedroom
            'name' => 'King Size Bed Frame',
            'slug' => 'king-size-bed-frame',
            'sku' => 'BED-001',
            'short_description' => 'Minimalist wooden bed frame.',
            'price' => 35000.00,
            'sale_price' => 32000.00,
            'image' => 'https://images.unsplash.com/photo-1505693416388-b0346ef12126?auto=format&fit=crop&w=500&q=80',
            'is_featured' => true,
        ]);
    }
}