<?php

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use App\Domains\Product\Models\ProductVariationType;
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
        $product = Product::where('ident', 'columbian-dark-roast')->first();

        $ground = ProductVariationType::create(['name' => 'Ground']);
        $wholeBean = ProductVariationType::create(['name' => 'Whole Bean']);


        $variations = [
            [
                'name' => '250g',
                'order' => 1,
            ],
            [
                'name' => '500g',
                'order' => 2,
                'price' => 1500,
            ],
            [
                'name' => '1kg',
                'order' => 3,
                'price' => 2000,
            ]
        ];

        foreach ($variations as $variation) {
            $variation['product_variation_type_id'] = $ground->id;
            $product->variations()->save(
                new ProductVariation($variation)
            );

            $variation['product_variation_type_id'] = $wholeBean->id;
            $product->variations()->save(
                new ProductVariation($variation)
            );
        }
    }
}
