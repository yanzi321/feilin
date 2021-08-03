<?php

use Faker\Generator as Faker;

$factory->define(App\ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'status' => random_int(0, 1),
        'sort' => random_int(-10, 50)
    ];
});
