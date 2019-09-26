<?php

namespace App\Http\Controllers\API\V1;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Resources\ProductIndexResource;
use App\Domains\Product\Resources\ProductResource;
use App\Filters\CategoryFilter;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::filters($this->filters())->paginate(10);

        return ProductIndexResource::collection($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    protected function filters()
    {
        return [
            'category' => new CategoryFilter()
        ];
    }
}
