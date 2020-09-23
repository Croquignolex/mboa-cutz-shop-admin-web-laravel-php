<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed type
 * @property mixed name
 */
class Role extends Model
{
    use SoftDeletes, SlugRouteTrait;

    const USER = 'user';
    const ADMIN = 'admin';
    const SUPER_ADMIN = 'super admin';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'slug'];

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * @return mixed
     */
    public function getNameAttribute()
    {
        if($this->type === Role::ADMIN) return "Administrateur";
        if($this->type === Role::SUPER_ADMIN) return "Super admin";
        else return "Utilisateur";
    }

    /**
     * @return mixed
     */
    public function getBadgeColorAttribute()
    {
        if($this->type === Role::ADMIN) return "success";
        if($this->type === Role::SUPER_ADMIN) return "danger";
        else return "primary";
    }
}