<?php

use App\Domains\Product\Models\ProductVariation;
use App\Domains\Product\Models\StockBlock;
use Illuminate\Database\Seeder;

class StockBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ProductVariation::get() as $variation) {
            $variation->stockBlocks()->save(
                new StockBlock(['quantity' => rand(10, 20)])
            );
        }
    }
}
