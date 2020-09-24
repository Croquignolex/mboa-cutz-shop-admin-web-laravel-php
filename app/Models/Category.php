<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed type
 */
class Category extends Model
{
    use SoftDeletes, SlugRouteTrait;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $guarded = ['slug', 'id', 'creator_id', 'is_activated'];

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}