<?php

namespace App\Listeners;

use App\Events\UserRestored;

class RestorePosts
{
    /**
     * Handle the event.
     *
     * @param UserRestored $event
     * @return void
     */
    public function handle(UserRestored $event)
    {
        $event->user->posts()->restore();
    }
}
