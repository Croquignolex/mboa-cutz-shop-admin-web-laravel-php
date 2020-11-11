<?php

namespace App\Observers;

use App\Models\Event;

class EventObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param Event $event
     * @return void
     */
    public function creating(Event $event)
    {
        $event->slug = $event->fr_name;
    }
}
