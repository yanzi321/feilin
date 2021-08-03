<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Text($faker));

    return [
        'name' => $faker->text(10),
        'sort' => random_int(-2, 30),
        'status' => [true, false][random_int(0, 1)],
    ];
});
