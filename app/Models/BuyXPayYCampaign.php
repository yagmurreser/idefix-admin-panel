<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuyXPayYCampaign extends Model
{
    protected $fillable = [
        'campaign_id',
        'product_id',
        'buy_quantity',
        'pay_quantity',
        'max_free_quantity',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}