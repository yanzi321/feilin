<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\zh_CN\Person($faker));
    $faker->addProvider(new \Faker\Provider\zh_TW\Text($faker));

    return [
        'title' => $faker->realText(20),
        'category_id' => random_int(1, 10),
        'author' => $faker->name,
        'cover' => $faker->imageUrl(300, 300),
        'description' => $faker->realText(100),
        'content' => $faker->realText(500),
        'status' => random_int(0, 1),
        'sort' => random_int(-10, 200),
        'published_at' => now()
    ];
});
