<?php

/** @var Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->paragraph
    ];
});

$factory
    ->state(Post::class, 'with_user', [])
    ->afterMakingState(Post::class, 'with_user', function ($post, $faker) {
        $user = factory(App\User::class)->create();
        $post->user_id = $user->id;
        $post->save();
    });

