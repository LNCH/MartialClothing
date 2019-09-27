<?php

use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Air Max Trainers',
                'ident' => 'air-max-trainers',
                'price' => 1500,
                'description' => 'A nice pair of Air Max trainers from Nike',
                'category' => 'clothing',
            ],
            [
                'name' => 'Superdry Jacket',
                'ident' => 'superdry-jacket',
                'price' => 2000,
                'description' => 'A really warm jacket',
                'category' => 'clothing',
            ],
            [
                'name' => 'Columbian Dark Roast',
                'ident' => 'columbian-dark-roast',
                'price' => 5000,
                'description' => 'Some really strong coffee',
                'category' => 'coffee'
            ]
        ];

        foreach ($products as $product) {
            $cat = $product['category'];
            unset($product['category']);

            $dbProduct = Product::firstOrCreate($product);
            $dbProduct->categories()->save(
                Category::where('ident', $cat)->first()
            );
        }
    }
}
