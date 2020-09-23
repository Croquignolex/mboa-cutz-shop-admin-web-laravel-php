<?php

namespace App\Traits;

trait DateTrait
{
    /**
     * Creation date
     *
     * @return mixed
     */
    public function getCreationDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    /**
     * Last update date
     *
     * @return mixed
     */
    public function getLastUpdateDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
}