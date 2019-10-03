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

    public function update($productId, $quantity)
    {
        $this->user->basket()->updateExistingPivot($productId, [
            'quantity' => $quantity
        ]);
    }

    public function delete($productId)
    {
        $this->user->basket()->detach($productId);
    }

    public function empty()
    {
        $this->user->basket()->detach();
    }

    public function isEmpty()
    {
        return $this->user->basket()->sum('quantity') === 0;
    }

    /**
     * @param array $products
     * @return array
     */
    protected function getStorePayload(array $products): array
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return ['quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id'])];
        })->toArray();
    }

    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->basket->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }

        return 0;
    }
}
