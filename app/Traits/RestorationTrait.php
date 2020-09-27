<?php

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

trait RestorationTrait
{
    /**
     * Check if connected user can be deleted
     *
     * @return mixed
     */
    public function getCanRestoreAttribute()
    {
        return Auth::user()->role->type === UserRole::SUPER_ADMIN;
    }
}