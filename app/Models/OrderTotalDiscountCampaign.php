<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTotalDiscountCampaign extends Model
{
    protected $fillable = [
        'campaign_id',
        'min_order_amount',
        'discount_percentage',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}