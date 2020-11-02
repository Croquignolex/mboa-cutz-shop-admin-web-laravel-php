<?php

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

trait SuperAdminOrCreatorCanDeleteTrait
{
    /**
     * Retrieve true while user is surper admin or creator
     *
     * @return mixed
     */
    public function superAdminOrCreatorCanDelete()
    {
        $connected_user = Auth::user();
        return (
            ($connected_user->role->type === UserRole::SUPER_ADMIN) ||
            ($this->creator === null) ||
            (Auth::user()->id === $this->creator->id)
        );
    }
}