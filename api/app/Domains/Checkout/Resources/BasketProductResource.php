<?php

namespace App\Domains\Checkout\Resources;

use App\Domains\Product\Resources\ProductIndexResource;
use App\Domains\Product\Resources\ProductVariationResource;
use App\Services\Money;

class BasketProductResource extends ProductVariationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request), [
                'product' => new ProductIndexResource($this->product),
                'quantity' => $this->pivot->quantity,
                'total' => $this->getTotal()->formatted()
            ]
        );
    }

    protected function getTotal(): Money
    {
        return new Money($this->pivot->quantity * $this->price->amount());
    }
}
