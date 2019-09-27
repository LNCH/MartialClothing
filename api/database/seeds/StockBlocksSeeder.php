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
            if ($variation->id % 3 !== 0) {
                $variation->stockBlocks()->save(
                    new StockBlock(['quantity' => 10])
                );
            }
        }
    }
}
