<?php

namespace Tests\Unit\Domains\Category\Models;

use App\Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    public function a_category_has_many_children(): void
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    /** @test */
    public function we_can_fetch_only_parents(): void
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertEquals(1, Category::parentsOnly()->count());
    }

    /** @test */
    public function we_can_order_all_categories_by_the_order_field(): void
    {
        $category = factory(Category::class)->create(['order' => 2]);
        $anotherCategory = factory(Category::class)->create(['order' => 1]);

        $this->assertEquals($anotherCategory->name, Category::ordered()->first()->name);
    }
}
