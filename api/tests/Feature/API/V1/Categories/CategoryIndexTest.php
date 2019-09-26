<?php

namespace Tests\Feature\Categories;

use App\Domains\Category\Models\Category;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection_of_categories(): void
    {
        $categories = factory(Category::class, 2)->create();

        $response = $this->getFromApi('categories');

        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'ident' => $category->ident
            ]);
        });
    }

    /** @test */
    public function the_index_only_returns_parent_categories(): void
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->getFromApi('categories')
            ->assertJsonCount(1, 'data');
    }

    /** @test */
    public function the_index_returns_categories_ordered_by_their_given_order(): void
    {
        $category = factory(Category::class)->create(['order' => 2]);
        $anotherCategory = factory(Category::class)->create(['order' => 1]);

        $this->getFromApi('categories')
            ->assertSeeInOrder([
                $anotherCategory->ident,
                $category->ident
            ]);
    }
}
