<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
