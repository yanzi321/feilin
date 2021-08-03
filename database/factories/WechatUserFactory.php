<?php

use Faker\Generator as Faker;

$factory->define(App\WechatUser::class, function (Faker $faker) {
    return [
        'openid' => str_random(20),
        'avatar' => $faker->imageUrl(300, 300),
        'nickname' => $faker->name
    ];
});
