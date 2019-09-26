<?php

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
            ],
            [
                'name' => 'Superdry Jacket',
                'ident' => 'superdry-jacket',
                'price' => 2000,
                'description' => 'A really warm jacket'
            ]
        ];

        foreach ($products as $product) {
            Product::firstOrCreate($product);
        }
    }
}
