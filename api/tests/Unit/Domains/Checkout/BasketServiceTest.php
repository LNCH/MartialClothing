<?php

namespace Tests\Unit\Domains\Checkout;

use App\Domains\Checkout\Services\BasketService;
use App\Domains\Product\Models\ProductVariation;
use App\Domains\User\Models\User;
use Tests\TestCase;

class BasketServiceTest extends TestCase
{
    /** @test */
    public function it_can_add_products_to_the_cart(): void
    {
        $basket = new BasketService(
            $user = create(User::class)
        );

        $product = create(ProductVariation::class);

        $basket->add([
            ['id' => $product->id, 'quantity' => 5]
        ]);

        $this->assertCount(1, $user->fresh()->basket);
    }

    /** @test */
    public function it_increments_quantity_when_adding_products(): void
    {
        $product = create(ProductVariation::class);

        $basket = new BasketService($user = create(User::class));
        $basket->add([
            ['id' => $product->id, 'quantity' => 5]
        ]);

        $basket = new BasketService($user->fresh());
        $basket->add([
            ['id' => $product->id, 'quantity' => 5]
        ]);

        $this->assertEquals($user->fresh()->basket->first()->pivot->quantity, 10);
    }
}
