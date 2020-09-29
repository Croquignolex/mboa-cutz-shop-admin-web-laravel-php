<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    /**
     * Handle the tag "created" event.
     *
     * @param Tag $tag
     * @return void
     */
    public function creating(Tag $tag)
    {
        $tag->slug = $tag->fr_name;
    }
}
