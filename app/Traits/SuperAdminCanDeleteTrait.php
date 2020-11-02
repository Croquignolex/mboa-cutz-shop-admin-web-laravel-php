<?php

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

trait SuperAdminCanDeleteTrait
{
    /**
     * Check if model can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        return (Auth::user()->role->type === UserRole::SUPER_ADMIN);
    }
}