<?php

namespace Tests\Feature\API\V1\Products;

use App\Domains\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    /** @test */
    public function fails_if_a_product_cant_be_found(): void
    {
        $this->getFromApi('products/nope')
            ->assertStatus(404);
    }

    /** @test */
    public function it_shows_a_product(): void
    {
        $product = factory(Product::class)->create();

        $this->getFromApi('products/' . $product->ident)
            ->assertJsonFragment([
                'id' => $product->id
            ]);
    }
}
