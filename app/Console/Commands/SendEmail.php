<?php

namespace App\Console\Commands;

use App\Mail\RecentPosts;
use App\Post;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $recentPosts = Post::query()
            ->whereDate('created_at', '>', today()->subWeek()->toDateString())
            ->latest()
            ->limit(10)
            ->get();

        User::query()
            ->limit(1) //TODO when I know laravel queues
            ->get()
            ->each(function ($user) use ($recentPosts) {

                $recentPosts = $recentPosts->filter(function ($post) use ($user) {
                    return $post->user_id != $user->id;
                });

                Mail::send(new RecentPosts($user, $recentPosts));
            });
    }
}
