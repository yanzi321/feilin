<?php

use Faker\Generator as Faker;

$factory->define(App\PayLog::class, function (Faker $faker) {
    return [
        'admin_id' => random_int(1, 5),
        'order_id' => random_int(1, 10),
        'paid_fee' => random_int(10, 100),
        'paid_at' => $faker->dateTimeThisMonth(),
        'remark' => $faker->text(100),
    ];
});
