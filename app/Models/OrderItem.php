<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relasi: OrderItem milik satu Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: OrderItem milik satu Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Accessor: Total harga item
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}