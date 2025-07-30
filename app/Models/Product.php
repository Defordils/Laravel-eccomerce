<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'sku',
        'stock_quantity',
        'category_id',
        'images',
        'is_active',
        'is_featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCurrentPrice()
    {
        return $this->sale_price ?? $this->price;
    }

    public function isOnSale()
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }
}
