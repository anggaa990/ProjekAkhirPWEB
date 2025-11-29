<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_id',
        'status',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Relasi: Order milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order milik satu Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Relasi: Order punya banyak OrderItems
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}