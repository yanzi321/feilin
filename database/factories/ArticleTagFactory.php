<?php

use Faker\Generator as Faker;

$factory->define(App\ArticleTag::class, function (Faker $faker) {
    return [
        'article_id' => random_int(1, 100),
        'tag_id' => random_int(1, 10),
    ];
});
