<?php

namespace App\Domains\Product\Resources;

use App\Domains\Product\Resources\ProductVariationResource;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'price' => $this->price,
            'variations' => ProductVariationResource::collection($this->variations)
        ]);
    }
}
