<?php

namespace Tests\Feature\API\V1\Basket;

use App\Domains\Product\Models\ProductVariation;
use App\Domains\User\Models\User;
use Tests\TestCase;

class BasketDestroyTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated(): void
    {
        $this->deleteFromApi('basket/1')
            ->assertStatus(401);
    }

    /** @test */
    public function it_fails_if_product_cant_be_found(): void
    {
        $user = create(User::class);

        $this->jsonDeleteAs($user, 'basket/1')
            ->assertStatus(404);
    }

    /** @test */
    public function it_deletes_an_item_from_the_cart(): void
    {
        $user = create(User::class);

        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 1
            ]
        );

        $this->jsonDeleteAs($user, 'basket/' . $product->id);

        $this->assertDatabaseMissing('user_basket', [
            'product_variation_id' => $product->id
        ]);
    }
}
