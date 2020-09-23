<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed type
 */
class Category extends Model
{
    use SoftDeletes, SlugRouteTrait, LocaleSlugSaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'fr_name', 'en_name', 'fr_description', 'en_description', 'is_activated'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'is_activated'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['is_activated' => 'boolean', 'created_at' => 'datetime:d-m-Y'];

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}