<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_title',
        'category_id',
        'barcode',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}