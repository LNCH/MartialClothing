<?php

namespace App\Domains\Product\Resources;

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
            'price' => $this->formattedPrice,
            'variations' => ProductVariationResource::collection(
                $this->variations->groupBy('type.name')
            )
        ]);
    }
}
