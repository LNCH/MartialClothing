<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\Product\Models\StockBlock;
use Faker\Generator as Faker;

$factory->define(StockBlock::class, function (Faker $faker) {
    return [
        'quantity' => 10
    ];
});
