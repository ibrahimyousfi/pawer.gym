<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'cin',
        'gender',
        'photo_path',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Status Logic
    |--------------------------------------------------------------------------
    */

    public function getStatusAttribute()
    {
        $today = now()->toDateString();

        // If has valid active subscription (ends in the future)
        if ($this->subscriptions()->where('end_date', '>', $today)->exists()) {
            return 'Active';
        }

        // If has expired subscription (ended today or earlier, and no future one)
        if ($this->subscriptions()->where('end_date', '<=', $today)->exists()) {
            return 'Expired';
        }

        // If no subscriptions at all
        return 'Inactive';
    }

    public function scopeActive($query)
    {
        return $query->whereHas('subscriptions', function ($q) {
            $q->where('end_date', '>', now()->toDateString());
        });
    }

    public function scopeExpired($query)
    {
        return $query->whereHas('subscriptions', function ($q) {
            $q->where('end_date', '<=', now()->toDateString());
        })->whereDoesntHave('subscriptions', function ($q) {
            $q->where('end_date', '>', now()->toDateString());
        });
    }

    public function scopeInactive($query)
    {
        return $query->doesntHave('subscriptions');
    }
}
