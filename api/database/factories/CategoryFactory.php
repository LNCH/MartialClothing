<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\Category\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $name =  $faker->unique()->name,
        'ident' => Str::slug($name),
    ];
});
