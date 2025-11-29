<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    // Relasi: Menu milik satu Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Menu punya banyak OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}