<?php

use Faker\Generator as Faker;

$factory->define(App\UserCashRequest::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1, 10),
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'cash_way' => random_int(1, 2),
        'alipay_account' => $faker->email,
        'bank_name' => $faker->company,
        'card_number' => $faker->creditCardNumber,
        'branch_name' => $faker->city,
        'cash_amount' => random_int(100, 10000) / 100,
        'status' => random_int(0, 2),
        'created_at' => $faker->dateTimeThisMonth,
        'updated_at' => $faker->dateTimeThisMonth,
    ];
});
