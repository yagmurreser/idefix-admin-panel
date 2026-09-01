<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    protected $fillable = [
        'author_name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}