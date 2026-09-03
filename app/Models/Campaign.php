<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'type',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function categoryDiscount(): HasOne
    {
        return $this->hasOne(CategoryDiscountCampaign::class);
    }

    public function orderTotalDiscount(): HasOne
    {
        return $this->hasOne(OrderTotalDiscountCampaign::class);
    }

    public function buyXPayY(): HasOne
    {
        return $this->hasOne(BuyXPayYCampaign::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}