<?php

namespace App\Domains\Checkout\Services;

use App\Domains\User\Models\User;

class BasketService
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function add(array $products): void
    {
        $products = $this->getStorePayload($products);

        $this->user->basket()->syncWithoutDetaching($products);
    }

    /**
     * @param array $products
     * @return array
     */
    protected function getStorePayload(array $products): array
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return ['quantity' => $product['quantity']];
        })->toArray();
    }
}
