<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class RecentPosts extends Mailable implements shouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Collection
     */
    public $posts;

    private $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Collection $posts
     */
    public function __construct(User $user, Collection $posts)
    {
        $this->user = $user;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('email.recent_posts_email'))
            ->to($this->user)
            ->subject(config('email.recent_posts_subject'))
            ->text('emails.newPosts', [
                'posts' => $this->posts,
                'user' => $this->user
            ]);
    }
}
