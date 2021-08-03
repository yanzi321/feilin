<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\ExternSalesman::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker));
    $faker->addProvider(new \Faker\Provider\zh_CN\PhoneNumber($faker));

    return [
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,

        'from' => random_int(0, 3),
        'from_id' => random_int(1, 3),
        'admin_id' => random_int(1, 3),
    ];
});
