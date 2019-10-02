<?php

namespace Tests\Feature\API\V1\Basket;

use App\Domains\Product\Models\ProductVariation;
use App\Domains\User\Models\User;
use Tests\TestCase;

class BasketUpdateTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated(): void
    {
        $this->patchToApi('basket/1')
            ->assertStatus(401);
    }

    /** @test */
    public function it_fails_if_product_cant_be_found(): void
    {
        $user = create(User::class);

        $this->jsonPatchAs($user, 'basket/1')
            ->assertStatus(404);
    }

    /** @test */
    public function it_requires_a_quantity(): void
    {
        $user = create(User::class);
        $product = create(ProductVariation::class);

        $this->jsonPatchAs($user, 'basket/' . $product->id)
            ->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_requires_a_numeric_quantity(): void
    {
        $user = create(User::class);
        $product = create(ProductVariation::class);

        $this->jsonPatchAs($user, 'basket/' . $product->id, [
            'quantity' => 'one'
        ])->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_requires_a_quantity_of_at_least_one(): void
    {
        $user = create(User::class);
        $product = create(ProductVariation::class);

        $this->jsonPatchAs($user, 'basket/' . $product->id, [
            'quantity' => 0
        ])->assertJsonValidationErrors(['quantity']);
    }

    /** @test */
    public function it_updates_the_quantity_of_a_basket_product(): void
    {
        $user = create(User::class);
        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 2
            ]
        );

        $this->jsonPatchAs($user, 'basket/' . $product->id, [
            'quantity' => 5
        ]);

        $this->assertDatabaseHas('user_basket', [
            'product_variation_id' => $product->id,
            'quantity' => 5
        ]);
    }
}
