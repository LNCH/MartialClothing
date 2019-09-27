<?php

namespace Tests\Unit\Domains\Product\Models;

use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use App\Services\Money;
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
        $product = create(Product::class);
        $product->categories()->save(
            create(Category::class)
        );

        $this->assertInstanceOf(Category::class, $product->categories->first());
    }

    /** @test */
    public function it_has_many_variations(): void
    {
        $product = create(Product::class);
        $product->variations()->save(
            create(ProductVariation::class)
        );

        $this->assertInstanceOf(ProductVariation::class, $product->variations->first());
    }

    /** @test */
    public function it_returns_a_money_instance_for_the_price(): void
    {
        $product = create(Product::class);

        $this->assertInstanceOf(Money::class, $product->price);
    }

    /** @test */
    public function it_returns_a_formatted_price(): void
    {
        $product = create(Product::class, [
            'price' => 1000
        ]);

        $this->assertEquals($product->formattedPrice, '£10.00');
    }
}
