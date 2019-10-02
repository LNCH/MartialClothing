<?php

namespace Tests\Unit\Domains\User\Models;

use App\Domains\Product\Models\ProductVariation;
use App\Domains\User\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_hashes_password_when_creating(): void
    {
        $user = create(User::class, ['password' => 'password']);

        $this->assertNotEquals($user->password, 'password');
    }

    /** @test */
    public function it_has_basket_products(): void
    {
        $user = create(User::class);

        $user->basket()->attach(
            create(ProductVariation::class)
        );

        $this->assertInstanceOf(ProductVariation::class, $user->basket->first());
    }

    /** @test */
    public function it_has_a_quantity_for_each_basket_product(): void
    {
        $user = create(User::class);

        $user->basket()->attach(
            create(ProductVariation::class), [
                'quantity' => $quantity = 5
            ]
        );

        $this->assertEquals($user->basket->first()->pivot->quantity, $quantity);
    }
}
