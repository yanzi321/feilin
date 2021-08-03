<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'product_category_id' => random_int(1, 10),
        'description' => $faker->realText(100),
        'commission' => random_int(100, 9999),
        'price' => random_int(10000, 999999),
        'status' => random_int(0, 1),
        'sort' => random_int(-10, 100)
    ];
});
