<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionPlan extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionPlanFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'price', 'billing_period', 'description', 'features', 'status'];

    protected $casts = ['features' => 'array'];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }
}
