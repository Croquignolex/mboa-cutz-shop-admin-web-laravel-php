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
        $date = $this->created_at;
        $date->setTimezone(session('timezone'));
        return $date->format('d M, Y à H:i');
    }

    /**
     * Last update date
     *
     * @return mixed
     */
    public function getLastUpdateDateAttribute()
    {
        $date = $this->updated_at;
        $date->setTimezone(session('timezone'));
        return $date->format('d M, Y à H:i');
    }
}