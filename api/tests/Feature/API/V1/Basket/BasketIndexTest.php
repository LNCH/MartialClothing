<?php

namespace Tests\Feature\API\V1\Basket;

use App\Domains\Product\Models\ProductVariation;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasketIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated(): void
    {
        $this->getFromApi('basket')
            ->assertStatus(401);
    }

    /** @test */
    public function it_shows_products_in_the_users_basket(): void
    {
        $user = create(User::class);

        $user->basket()->sync(
            $product = create(ProductVariation::class)
        );

        $this->jsonGetAs($user, 'basket')
            ->assertJsonFragment([
                'id' => $product->id
            ]);
    }

    /** @test */
    public function it_shows_a_formatted_subtotal(): void
    {
        $user = create(User::class);

        $this->jsonGetAs($user, 'basket')
            ->assertJsonFragment([
                'subtotal' => '£0.00'
            ]);
    }

    /** @test */
    public function it_shows_a_formatted_total(): void
    {
        $user = create(User::class);

        $this->jsonGetAs($user, 'basket')
            ->assertJsonFragment([
                'total' => '£0.00'
            ]);
    }

    /** @test */
    public function it_syncs_the_basket(): void
    {
        $user = create(User::class);

        $user->basket()->attach(
            $product = create(ProductVariation::class), [
                'quantity' => 2
            ]
        );

        $this->jsonGetAs($user, 'basket')
            ->assertJsonFragment([
                'was_changed' => true
            ]);
    }
}
