<?php

use App\Domains\Category\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clothing = Category::firstOrCreate([
            'name' => 'Clothing',
            'ident' => 'clothing',
            'order' => 1,
        ]);

        $equipment = Category::firstOrCreate([
            'name' => 'Equipment',
            'ident' => 'equipment',
            'order' => 2,
        ]);

        $tShirts = Category::firstOrCreate([
            'name' => 'T-Shirts',
            'ident' => 't-shirts',
            'parent_id' => $clothing->id
        ]);
    }
}
