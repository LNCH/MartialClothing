<?php

namespace App\Domains\Product\Models;

use App\Concerns\HasPrice;
use App\Services\Money;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasPrice;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type()
    {
        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }

    public function stockBlocks()
    {
        return $this->hasMany(StockBlock::class);
    }

    public function stockInformation()
    {
        return $this->hasOne(StockInformation::class);
    }

    public function stockCount()
    {
        return $this->stockInformation->stock;
    }

    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    public function getPriceAttribute($value)
    {
        if ($value === null) {
            return $this->product->price;
        }

        return new Money($value);
    }

    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    public function minStock($amount)
    {
        return min($amount, $this->stockCount());
    }
}
