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

    /** @test */
    public function it_can_update_a_basket_product_quantity(): void
    {
        $basket = new BasketService(
            $user = create(User::class)
        );

        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 1
            ]
        );

        $basket->update($product->id, 5);

        $this->assertEquals($user->fresh()->basket->first()->pivot->quantity, 5);
    }

    /** @test */
    public function it_can_delete_a_product_from_the_basket(): void
    {
        $basket = new BasketService(
            $user = create(User::class)
        );

        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 1
            ]
        );

        $basket->delete($product->id);

        $this->assertCount(0, $user->fresh()->basket);
    }

    /** @test */
    public function it_can_empty_the_basket(): void
    {
        $basket = new BasketService(
            $user = create(User::class)
        );

        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 1
            ]
        );

        $basket->empty();

        $this->assertCount(0, $user->fresh()->basket);
    }

    /** @test */
    public function it_can_check_if_the_basket_is_empty_based_on_quantities(): void
    {
        $basket = new BasketService(
            $user = create(User::class)
        );

        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 0
            ]
        );

        $this->assertTrue($basket->isEmpty());
    }

    /** @test */
    public function it_shows_if_the_cart_is_empty(): void
    {
        $user = create(User::class);

        $this->jsonGetAs($user, 'basket')
            ->assertJsonFragment([
                'empty' => true
            ]);
    }
}
