<?php

use Faker\Generator as Faker;

$factory->define(App\ConsultLog::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker));
    $faker->addProvider(new \Faker\Provider\zh_TW\Text($faker));
    $faker->addProvider(new \Faker\Provider\zh_CN\PhoneNumber($faker));

    return [
        'user_id' => 0,
        'activity_summer_camp_id' => random_int(1, 20),
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'content' => $faker->realText(50),
    ];
});
