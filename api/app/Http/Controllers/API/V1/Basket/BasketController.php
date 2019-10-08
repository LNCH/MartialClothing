<?php

namespace App\Http\Controllers\API\V1\Basket;

use App\Domains\Checkout\Requests\BasketStoreRequest;
use App\Domains\Checkout\Requests\BasketUpdateRequest;
use App\Domains\Checkout\Resources\BasketResource;
use App\Domains\Checkout\Services\BasketService;
use App\Domains\Product\Models\ProductVariation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(Request $request, BasketService $basket)
    {
        $basket->sync();

        $request->user()->load([
            'basket.product',
            'basket.product.variations.stockInformation',
            'basket.stockInformation',
        ]);

        return (new BasketResource($request->user()))
            ->additional([
                'meta' => $this->meta($basket)
            ]);
    }

    private function meta($basket)
    {
        return [
            'empty' => $basket->isEmpty(),
            'subtotal' => $basket->subtotal()->formatted(),
            'total' => $basket->total()->formatted(),
            'was_changed' => $basket->hasBeenChanged()
        ];
    }

    public function store(BasketStoreRequest $request, BasketService $basket)
    {
        $basket->add($request->products);
    }

    public function update(ProductVariation $productVariation, BasketUpdateRequest $request, BasketService $basket)
    {
        $basket->update($productVariation->id, $request->quantity);
    }

    public function destroy(ProductVariation $productVariation, BasketService $basket)
    {
        $basket->delete($productVariation->id);
    }
}
