<?php

namespace App\Observers;

use App\Models\Service;

class ServiceObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param Service $service
     * @return void
     */
    public function creating(Service $service)
    {
        $service->slug = $service->fr_name;
    }
}
