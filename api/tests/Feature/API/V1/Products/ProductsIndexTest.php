<?php

namespace Tests\Feature\API\V1\Products;

use App\Domains\Product\Models\Product;
use Tests\TestCase;

class ProductsIndexTest extends TestCase
{
    /** @test */
    public function it_shows_a_collection_of_products(): void
    {
        $products = factory(Product::class, 2)->create();

        $response = $this->getFromApi('products');

        $products->each(function ($product) use ($response) {
            $response->assertJsonFragment([
                'id' => $product->id
            ]);
        });
    }

    /** @test */
    public function it_has_paginated_data(): void
    {
        $this->getFromApi('products')
            ->assertJsonStructure([
                'data', 'links', 'meta'
            ]);
    }
}
