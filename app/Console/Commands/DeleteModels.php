<?php

namespace App\Console\Commands;

use App\Post;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeleteModels extends Command
{
    use SoftDeletes;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'models:force-delete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::onlyTrashed()->each(function ($user) {
            $user->whereDate('deleted_at', '<', today()->toDateString())
                ->forceDelete();
        });

        Post::onlyTrashed()->each(function ($post) {
            $post->whereDate('deleted_at', '<', today()->toDateString())
                ->forceDelete();
        });
    }
}
