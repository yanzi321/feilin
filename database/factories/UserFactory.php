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

$factory->define(App\User::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker));
    $faker->addProvider(new \Faker\Provider\zh_CN\Company($faker));
    $faker->addProvider(new \Faker\Provider\zh_CN\PhoneNumber($faker));

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => str_random(10),

        'consult_at' => $faker->dateTimeThisMonth(),
        'sex' => random_int(1, 3),
        'age' => random_int(15, 26),
        'grade' => random_int(9, 15),
        'school' => $faker->company,
        'wants_country' => $faker->country,
        'language_level' => ['CET-4', 'CET-8'][random_int(0, 1)],
        'parent_name' => $faker->name,
        'parent_tel' => $faker->phoneNumber,
        'wechat' => $faker->text(8),

        'is_partner' => random_int(0, 1),
        'partner_status' => random_int(0, 1),
        'tel' => $faker->phoneNumber,
        'real_name' => $faker->name,

        'from' => random_int(0, 3),
        'from_id' => random_int(1, 3),

        'nickname' => $faker->name,
        'openid' => str_random(20),
        'unionid' => str_random(20),
        'avatar' => $faker->imageUrl(100, 100),
        'wechat_snapshot' => \json_encode_unicode([
            'nickname' => $faker->name,
            'openid' => str_random(20),
            'unionid' => str_random(20),
        ]),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
        'place' => $faker->country,
        'invite_code' => $faker->text(5),
        'partner_apply_at' => $faker->dateTimeThisYear,
        'partner_approval_at' => $faker->dateTimeThisYear,
    ];
});
