<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 100)
            ->make()
            ->each(function ($post) {
                $randomUser = App\User::inRandomOrder()->first();
                $post->user_id = $randomUser->id;
                $post->save();
            });
    }
}
