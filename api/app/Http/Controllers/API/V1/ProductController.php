<?php

namespace App\Http\Controllers\API\V1;

use App\Domains\Product\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return ProductIndexResource::collection($products);
    }

    public function show(Product $product)
    {

    }
}
