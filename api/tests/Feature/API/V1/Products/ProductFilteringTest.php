<?php

namespace Tests\Feature\API\V1\Products;

use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\Product;
use Tests\TestCase;

class ProductFilteringTest extends TestCase
{
    /** @test */
    public function it_can_filter_products_by_category(): void
    {
        $products = factory(Product::class, 2)->create();
        $products->get(0)->categories()->save(
            $category = factory(Category::class)->create()
        );

        $this->getFromApi("products", ['category' => $category->ident])
            ->assertJsonCount(1, 'data');
    }
}
