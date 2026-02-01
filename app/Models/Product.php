<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'gym_id',
        'name',
        'price',
        'stock',
        'image_path',
    ];

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
