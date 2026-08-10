<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model



{
    use SoftDeletes;
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