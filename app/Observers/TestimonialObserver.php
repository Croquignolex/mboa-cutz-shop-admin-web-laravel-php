<?php

namespace App\Observers;

use App\Models\Testimonial;

class TestimonialObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param Testimonial $testimonial
     * @return void
     */
    public function creating(Testimonial $testimonial)
    {
        $testimonial->slug = $testimonial->name;
    }
}
