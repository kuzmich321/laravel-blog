<?php

/** @var Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'created_at' => $faker->dateTimeBetween('- 180 days', 'now'),
        'updated_at' => function (array $post) {
            return $post['created_at'];
        }
    ];
});
