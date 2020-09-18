<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed type
 */
class Article extends Model
{
    const USER = 'user';
    const ADMIN = 'admin';
    const SUPER_ADMIN = 'super admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];

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
}