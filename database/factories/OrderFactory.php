<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'order_sn' => strtoupper(str_random(20)),
        'user_id' => random_int(1, 20),
        'activity_summer_camp_id' => random_int(1, 20),
        'admin_id' => random_int(1, 20),
        'product_id' => random_int(1, 10),
        'product_snapshot' => \json_encode(['id' => 1, 'commission' => random_int(1, 100)]),
        'wants_country' => 'com',
        'total_fee' => random_int(100, 1000),
        'left_fee' => random_int(100, 1000),
        'from' => random_int(1, 2),
        'from_id' => random_int(1, 2),
        'commission' => random_int(1, 100),
        'paid_fee' => random_int(100, 1000),
        'status' => random_int(0,7),
        'created_at' => $faker->dateTimeThisYear
    ];
});
