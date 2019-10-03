<?php

namespace App\Domains\Checkout\Services;

use App\Domains\User\Models\User;
use App\Services\Money;

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
        return $this->user->basket->sum('pivot.quantity') === 0;
    }

    public function subtotal()
    {
        $subtotal = $this->user->basket->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    public function total()
    {
        return $this->subtotal();
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
