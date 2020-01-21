<?php

/** @var Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => file_get_contents('http://loripsum.net/api/1/short/plaintext')
    ];
});
