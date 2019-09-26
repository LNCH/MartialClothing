<?php

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use Illuminate\Database\Seeder;

class ProductVariationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::where('ident', 'air-max-trainers')->first();

        $variations = [
            [
                'name' => 'UK 9',
                'order' => 1,
            ],
            [
                'name' => 'UK 10',
                'order' => 2,
            ],
            [
                'name' => 'UK 11',
                'order' => 3,
            ]
        ];

        foreach ($variations as $variation) {
            $variation['product_id'] = $product->id;
            $product->variations()->save(
                ProductVariation::create($variation)
            );
        }
    }
}
