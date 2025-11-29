<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id','table_id','date','time','people','status','notes'];
    
    public function user() { 
        return $this->belongsTo(User::class); 
    }
    
    public function table() { 
        return $this->belongsTo(RestaurantTable::class, 'table_id'); 
    }
    
    public function order() { 
        return $this->hasOne(Order::class); 
    }
    
    public function review() { 
        return $this->hasOne(Review::class); 
    }
}