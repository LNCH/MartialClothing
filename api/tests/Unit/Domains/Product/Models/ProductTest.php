<?php

namespace Tests\Unit\Domains\Product\Models;

use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function it_uses_the_ident_for_the_route_key_name(): void
    {
        $product = new Product();

        $this->assertEquals($product->getRouteKeyName(), 'ident');
    }

    /** @test */
    public function it_has_many_categories(): void
    {
        $product = factory(Product::class)->create();
        $product->categories()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $product->categories->first());
    }

    /** @test */
    public function it_has_many_variations(): void
    {
        $product = factory(Product::class)->create();
        $product->variations()->save(
            factory(ProductVariation::class)->create()
        );

        $this->assertInstanceOf(ProductVariation::class, $product->variations->first());
    }
}
