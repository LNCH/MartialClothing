<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\ProductVariation;
use App\Domains\Product\Models\ProductVariationType;
use Faker\Generator as Faker;

$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class)->create()->id,
        'product_variation_type_id' => factory(ProductVariationType::class)->create()->id,
        'name' => $faker->unique()->name,
    ];
});
