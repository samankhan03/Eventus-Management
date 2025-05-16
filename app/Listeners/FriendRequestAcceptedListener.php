<?php

namespace App\Listeners;

use App\Events\FriendRequestAcceptedEvent;
use App\Notifications\FriendRequestAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FriendRequestAcceptedListener
{
    /**
     * Creates the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handles the event.
     *
     * @param  FriendRequestAcceptedEvent  $event
     * @return void
     */
    public function handle(FriendRequestAcceptedEvent $event) {
        $event->user->notify(new FriendRequestAccepted(auth()->user()));
    }
}
