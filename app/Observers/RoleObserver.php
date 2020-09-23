<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param Role $role
     * @return void
     */
    public function creating(Role $role)
    {
        $role->slug = $role->type;
    }
}
