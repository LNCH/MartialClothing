<?php

namespace App\Http\Controllers\API\V1\Basket;

use App\Domains\Checkout\Requests\BasketStoreRequest;
use App\Domains\Checkout\Services\BasketService;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function store(BasketStoreRequest $request, BasketService $basket)
    {
        $basket->add($request->products);
    }
}
