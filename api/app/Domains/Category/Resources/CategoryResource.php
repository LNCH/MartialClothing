<?php

namespace App\Domains\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'ident' => $this->ident,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }
}
