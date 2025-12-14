<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',     // ✅ Tambahkan
        'customer_phone',    // ✅ Tambahkan
        'customer_email',    // ✅ Tambahkan
        'table_id',
        'date',
        'time',
        'people',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}