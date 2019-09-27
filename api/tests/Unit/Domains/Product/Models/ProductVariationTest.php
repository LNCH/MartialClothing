<?php

namespace Tests\Unit\Domains\Product\Models;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use App\Domains\Product\Models\ProductVariationType;
use Tests\TestCase;

class ProductVariationTest extends TestCase
{
    /** @test */
    public function it_has_one_variation_type(): void
    {
        $variation = create(ProductVariation::class);

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    /** @test */
    public function it_belongs_to_a_product(): void
    {
        $variation = create(ProductVariation::class);

        $this->assertInstanceOf(Product::class, $variation->product);
    }
}
