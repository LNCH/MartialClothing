<?php

namespace Tests\Feature\API\V1\Basket;

use App\Domains\Product\Models\ProductVariation;
use App\Domains\User\Models\User;
use Tests\TestCase;

class BasketStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated(): void
    {
        $this->postToApi('basket')
            ->assertStatus(401);
    }

    /** @test */
    public function it_requires_products(): void
    {
        $user = create(User::class);
        $this->jsonPostAs($user, 'basket')
            ->assertJsonValidationErrors(['products']);
    }

    /** @test */
    public function it_requires_an_array_of_products(): void
    {
        $user = create(User::class);
        $this->jsonPostAs($user, 'basket', [
            'products' => 1
        ])->assertJsonValidationErrors(['products']);
    }

    /** @test */
    public function it_requires_an_id_for_each_product(): void
    {
        $user = create(User::class);
        $this->jsonPostAs($user, 'basket', [
            'products' => [
                ['quantity' => 1]
            ]
        ])->assertJsonValidationErrors(['products.0.id']);
    }

    /** @test */
    public function it_requires_each_product_to_exist(): void
    {
        $user = create(User::class);
        $this->jsonPostAs($user, 'basket', [
            'products' => [
                ['id' => 1, 'quantity' => 1]
            ]
        ])->assertJsonValidationErrors(['products.0.id']);
    }

    /** @test */
    public function it_requires_the_quantity_to_be_numeric(): void
    {
        $user = create(User::class);
        $this->jsonPostAs($user, 'basket', [
            'products' => [
                ['id' => 1, 'quantity' => 'one']
            ]
        ])->assertJsonValidationErrors(['products.0.quantity']);
    }

    /** @test */
    public function it_requires_the_quantity_to_be_at_least_one(): void
    {
        $user = create(User::class);
        $this->jsonPostAs($user, 'basket', [
            'products' => [
                ['id' => 1, 'quantity' => 0]
            ]
        ])->assertJsonValidationErrors(['products.0.quantity']);
    }

    /** @test */
    public function it_can_add_products_to_the_users_basket(): void
    {
        $user = create(User::class);
        $product = create(ProductVariation::class);

        $this->jsonPostAs($user, 'basket', [
            'products' => [
                ['id' => $product->id, 'quantity' => 2]
            ]
        ]);

        $this->assertDatabaseHas('user_basket', [
            'product_variation_id' => $product->id,
            'quantity' => 2
        ]);
    }
}
