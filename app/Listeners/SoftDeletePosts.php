<?php

namespace App\Listeners;

use App\Events\UserSoftDeleted;

class SoftDeletePosts
{
    /**
     * Handle the event.
     *
     * @param UserSoftDeleted $event
     * @return void
     */
    public function handle(UserSoftDeleted $event)
    {
        $event->user->posts()->delete();
    }
}
