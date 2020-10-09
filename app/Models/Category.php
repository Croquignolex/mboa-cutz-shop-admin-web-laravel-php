<?php

namespace App\Models;

use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SuperAdminOrCreatorCanDeleteTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed fr_name
 * @property mixed slug
 * @property mixed products
 * @property mixed creator
 * @property mixed can_delete
 * @property mixed services
 * @property mixed articles
 */
class Category extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait, SuperAdminOrCreatorCanDeleteTrait;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $guarded = ['slug', 'id', 'creator_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fr_name', 'en_name', 'description'];

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    /**
     * @return HasMany
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    /**
     * @return HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * Check if category can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        return (
            (
                ($this->products->count() === 0) &&
                ($this->services->count() === 0) &&
                ($this->articles->count() === 0)
            ) &&
            $this->superAdminOrCreatorCanDelete()
        );
    }
}