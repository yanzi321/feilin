<?php

use Faker\Generator as Faker;

$factory->define(App\CommissionLog::class, function (Faker $faker) {
    return [
        'order_id' => random_int(1, 10),
        'user_id' => random_int(1, 10),
        'partner_id' => random_int(1, 10),
        'commission' => random_int(1000, 10000) / 100,
        'commission_rule_id' => random_int(1, 4),
        'commission_rule_snapshot' => 'todo',
    ];
});
