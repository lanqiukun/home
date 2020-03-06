<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        //
        'title' => $faker -> title,
        'desc' => $faker -> word,
        'status' => (string)rand(0, 2),
        'cover' => $faker -> imageUrl($width = 640, $height = 480),
        'content' => $faker -> text,
    ];
});
