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
}
