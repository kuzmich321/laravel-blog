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

        $delay = now();

        User::get()
            ->each(function ($user) use ($recentPosts, $delay) {

                $recentPosts = $recentPosts->filter(function ($post) use ($user) {
                    return $post->user_id != $user->id;
                });

                Mail::later($delay->addMinute(), new RecentPosts($user, $recentPosts));
            });
    }
}
