<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'subscription_expires_at',
        'is_active',
    ];

    protected $casts = [
        'subscription_expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function trainingTypes()
    {
        return $this->hasMany(TrainingType::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function isSubscriptionExpired()
    {
        return $this->subscription_expires_at && $this->subscription_expires_at < now();
    }

    public function getDaysUntilExpiry()
    {
        if (!$this->subscription_expires_at) {
            return null;
        }

        return now()->diffInDays($this->subscription_expires_at, false);
    }
}
