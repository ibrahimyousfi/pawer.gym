<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'gym_id',
        'user_id',
        'total_amount',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
