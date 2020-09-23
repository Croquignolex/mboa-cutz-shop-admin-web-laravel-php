<?php

namespace App\Models;

use App\Enums\Constants;
use App\Traits\SlugRouteTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed id
 * @property mixed role
 * @property mixed email
 * @property mixed avatar
 * @property mixed phone
 * @property mixed post_code
 * @property mixed city
 * @property mixed country
 * @property mixed profession
 * @property mixed address
 * @property mixed description
 * @property mixed full_name
 * @property mixed last_name
 * @property mixed first_name
 * @property mixed avatar_src
 * @property mixed password
 * @property mixed format_full_name
 * @property mixed format_last_name
 * @property mixed avatar_extension
 * @property mixed format_first_name
 */
class User extends Authenticate
{

    use SoftDeletes, SlugRouteTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'is_confirmed', 'role_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'password', 'is_confirmed', 'email', 'role_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['is_confirmed' => 'boolean', 'created_at' => 'datetime:d-m-Y'];

    /**
     * Boot functions
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->password = Hash::make($user->password);
        });
    }

    /**
     * User role
     *
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->format_first_name} {$this->format_last_name}";
    }

    /**
     * User formatted first name
     *
     * @return mixed
     */
    public function getFormatFirstNameAttribute()
    {
        return ucfirst(mb_strtolower($this->first_name));
    }

    /**
     * User formatted last name
     *
     * @return mixed
     */
    public function getFormatLastNameAttribute()
    {
        return mb_strtoupper($this->last_name);
    }

    /**
     * User avatar image src
     *
     * @return string
     */
    public function getAvatarSrcAttribute() {
        // Update une avatar with default if avatar file is not found
        if(!Storage::exists(user_img_asset($this->avatar, $this->avatar_extension))) {
            $this->update([
                'avatar' => Constants::DEFAULT_IMAGE,
                'avatar_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return user_img_asset($this->avatar, $this->avatar_extension);
    }

    /**
     * Check if user can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteUserAttribute()
    {
        return (
            (Auth::user()->id !== $this->id) &&
            (
                ($this->role->type === Role::USER && Auth::user()->role->type !== Role::USER) ||
                ($this->role->type === Role::ADMIN && Auth::user()->role->type === Role::SUPER_ADMIN)
            )
        );
    }

    /**
     * Check if user can grand admin privileges
     *
     * @return mixed
     */
    public function getCanGrantAdminUserAttribute()
    {
        return (
            (Auth::user()->id !== $this->id) &&
            ($this->role->type === Role::USER) &&
            (Auth::user()->role->type !== Role::USER)
        );
    }

    /**
     * Check if user can grand super admin privileges
     *
     * @return mixed
     */
    public function getCanGrantSuperAdminUserAttribute()
    {
        return (
            (Auth::user()->id !== $this->id) &&
            ($this->role->type !== Role::SUPER_ADMIN) &&
            (Auth::user()->role->type === Role::SUPER_ADMIN)
        );
    }
}