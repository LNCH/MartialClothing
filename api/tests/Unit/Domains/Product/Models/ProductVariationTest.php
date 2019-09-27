<?php

namespace Tests\Unit\Domains\Product\Models;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use App\Domains\Product\Models\ProductVariationType;
use App\Domains\Product\Models\StockBlock;
use App\Domains\Product\Models\StockInformation;
use App\Services\Money;
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

    /** @test */
    public function it_returns_a_money_instance_for_the_price(): void
    {
        $variation = create(ProductVariation::class);

        $this->assertInstanceOf(Money::class, $variation->price);
    }

    /** @test */
    public function it_returns_a_formatted_price(): void
    {
        $variation = create(ProductVariation::class, [
            'price' => 1000
        ]);

        $this->assertEquals($variation->formattedPrice, '£10.00');
    }

    /** @test */
    public function it_inherits_the_base_price_if_price_is_null(): void
    {
        $product = create(Product::class, [
            'price' => 1000
        ]);

        $variation = create(ProductVariation::class, [
            'price' => null,
            'product_id' => $product->id
        ]);

        $this->assertEquals($product->price->amount(), $variation->price->amount());
    }

    /** @test */
    public function it_can_check_if_the_variation_price_is_different_to_the_product(): void
    {
        $product = create(Product::class, [
            'price' => 1000
        ]);

        $variation = create(ProductVariation::class, [
            'price' => 2000,
            'product_id' => $product->id
        ]);

        $this->assertTrue($variation->priceVaries());
    }

    /** @test */
    public function it_has_many_stocks(): void
    {
        $variation = create(ProductVariation::class);

        $variation->stockBlocks()->save(
            make(StockBlock::class)
        );

        $this->assertInstanceOf(StockBlock::class, $variation->stockBlocks->first());
    }

    /** @test */
    public function it_has_stock_information(): void
    {
        $variation = create(ProductVariation::class);

        $variation->stockBlocks()->save(
            make(StockBlock::class)
        );

        $this->assertInstanceOf(StockInformation::class, $variation->stockInformation);
    }

    /** @test */
    public function it_has_stock_count_pivot_within_stock_information(): void
    {
        $variation = create(ProductVariation::class);

        $variation->stockBlocks()->save(
            make(StockBlock::class, [
                'quantity' => $quantity = 5
            ])
        );

        $this->assertEquals($variation->stockInformation->stock, $quantity);
    }

    /** @test */
    public function it_shows_if_product_is_in_stock_in_stock_information(): void
    {
        $variation = create(ProductVariation::class);

        $variation->stockBlocks()->save(
            make(StockBlock::class)
        );

        $this->assertTrue((bool) $variation->stockInformation->in_stock);
    }

    /** @test */
    public function it_can_check_if_in_stock_using_helper_method(): void
    {
        $variation = create(ProductVariation::class);

        $variation->stockBlocks()->save(
            make(StockBlock::class)
        );

        $this->assertTrue($variation->inStock());
    }

    /** @test */
    public function it_shows_the_stock_count_using_the_helper_method(): void
    {
        $variation = create(ProductVariation::class);

        $variation->stockBlocks()->save(
            make(StockBlock::class, ['quantity' => 5])
        );
        $variation->stockBlocks()->save(
            make(StockBlock::class, ['quantity' => 5])
        );

        $this->assertEquals($variation->stockCount(), 10);
    }
}
