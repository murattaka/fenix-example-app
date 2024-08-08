<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $keyType = 'string';  
    public $incrementing = false; 
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'daily_credit_limit',
        'subscription_days',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
