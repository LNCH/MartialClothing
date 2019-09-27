<?php

namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type()
    {
        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }
}
