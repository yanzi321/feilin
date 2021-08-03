<?php

use Faker\Generator as Faker;

$factory->define(App\ActivitySummerCamp::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'wants_country' => $faker->country,
        'ip' => $faker->ipv4,
        'user_id' => random_int(1, 20),
        'from_id' => random_int(1, 20),
        'from' => random_int(1, 2),
        'consult_at' => $faker->dateTimeThisMonth(),
        'sex' => random_int(1, 3),
        'age' => random_int(15, 26),
        'grade' => random_int(9, 15),
        'school' => $faker->company,
        'place' => $faker->address,
        'language_level' => ['CET-4', 'CET-8'][random_int(0, 1)],
        'parent_name' => $faker->name,
        'parent_tel' => $faker->phoneNumber,
    ];
});
