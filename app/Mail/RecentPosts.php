<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class RecentPosts extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Collection
     */
    public $posts;

    /**
     * Create a new message instance.
     *
     * @param Collection $posts
     */
    public function __construct(Collection $posts)
    {
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
            ->subject(config('email.recent_posts_subject'))
            ->text('emails.newPosts', ['posts' => $this->posts]);
    }
}
