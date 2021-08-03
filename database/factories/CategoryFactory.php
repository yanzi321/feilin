<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker));
    $faker->addProvider(new \Faker\Provider\zh_TW\Text($faker));

    return [
        'name' => $faker->name,
        'description' => $faker->realText(10),
        'sort' => random_int(-2, 30),
        'status' => random_int(0, 1),
        'articles_count' => random_int(1, 200)
    ];
});
