<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function productTypes(): BelongsToMany
    {
        return $this->belongsToMany(ProductType::class, 'product_product_type');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
