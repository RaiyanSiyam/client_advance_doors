<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Allow mass assignment for everything except ID

    // Relationship: An Order has many Order Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship: An Order belongs to a User (nullable for guest checkout)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}