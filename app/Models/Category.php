<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed fr_name
 * @property mixed slug
 * @property mixed products
 * @property mixed creator
 * @property mixed can_delete
 * @property mixed services
 */
class Category extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait;

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
     * Check if tag can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        $connected_user = Auth::user();
        return (
            (
                ($this->products->count() === 0) &&
                ($this->services->count() === 0)
            ) &&
            (
                ($connected_user->role->type === UserRole::SUPER_ADMIN) ||
                ($this->creator === null) ||
                (Auth::user()->id === $this->creator->id)
            )
        );
    }
}