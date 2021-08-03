<?php

use Faker\Generator as Faker;

$factory->define(App\Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'logo' => $faker->imageUrl(100, 100),
        'description' => $faker->text(100),
        'url' => $faker->url,
        'status' => random_int(0, 1),
        'sort' => random_int(-10, 100),
        'added_at' => $faker->dateTimeThisYear,
        'tel' => $faker->phoneNumber
    ];
});
