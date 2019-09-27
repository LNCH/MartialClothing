<?php

namespace App\Concerns;

use App\Services\Money;

trait HasPrice
{
    public function getPriceAttribute($value)
    {
        return new Money($value);
    }

    public function getFormattedPriceAttribute()
    {
        return $this->price->formatted();
    }
}
