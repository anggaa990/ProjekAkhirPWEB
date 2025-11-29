<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'status',
    ];

    // Relasi: Table punya banyak Reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }
}