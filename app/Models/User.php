<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\Constants;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property mixed slug
 * @property mixed logs
 * @property mixed creator
 * @property mixed can_show
 * @property mixed can_edit
 * @property mixed can_delete
 * @property mixed can_restore
 * @property mixed can_grant_super_admin_user
 * @property mixed can_grant_admin_user
 */
class User extends Authenticate
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['slug', 'id', 'is_confirmed', 'role_id', 'creator_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'description', 'post_code',
        'city', 'country', 'profession', 'address', 'email'
    ];

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
     * User logs
     *
     * @return HasMany
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Log');
    }

    /**
     * User logs
     *
     * @return HasMany
     */
    public function created_users()
    {
        return $this->hasMany('App\Models\User', 'creator_id');
    }

    /**
     * User categories
     *
     * @return HasMany
     */
    public function created_categories()
    {
        return $this->hasMany('App\Models\Category', 'creator_id');
    }

    /**
     * User categories
     *
     * @return HasMany
     */
    public function created_tags()
    {
        return $this->hasMany('App\Models\Tag', 'creator_id');
    }

    /**
     * Slug mutator
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
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
     * Check if connected user can grand admin privileges
     *
     * @return mixed
     */
    public function getCanGrantAdminUserAttribute()
    {
        $connected_user = Auth::user();
        return (
            ($connected_user->id !== $this->id) &&
            (
                (
                    ($this->role->type === UserRole::USER) &&
                    (
                        ($connected_user->role->type === UserRole::ADMIN) ||
                        ($connected_user->role->type === UserRole::SUPER_ADMIN)
                    )
                ) ||
                (
                    ($this->role->type === UserRole::SUPER_ADMIN) &&
                    ($connected_user->role->type === UserRole::SUPER_ADMIN)
                )
            )
        );
    }

    /**
     * Check if connected user can grand super admin privileges
     *
     * @return mixed
     */
    public function getCanGrantSuperAdminUserAttribute()
    {
        $connected_user = Auth::user();
        return (
            ($connected_user->id !== $this->id) &&
            ($this->role->type !== UserRole::SUPER_ADMIN) &&
            ($connected_user->role->type === UserRole::SUPER_ADMIN)
        );
    }

    /**
     * Check if connected user can show user details
     *
     * @return mixed
     */
    public function getCanShowAttribute()
    {
        return Auth::user()->id !== $this->id;
    }

    /**
     * Check if connected user can edit user details
     *
     * @return mixed
     */
    public function getCanEditAttribute()
    {
        return $this->updateAndDeleteLogic();
    }

    /**
     * Check if connected user can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        return $this->updateAndDeleteLogic();
    }

    /**
     * Update and delete logic
     *
     * @return bool
     */
    private function updateAndDeleteLogic() {
        $connected_user = Auth::user();
        return (
            ($connected_user->id !== $this->id) &&
            (
                (
                    ($this->role->type === UserRole::USER) &&
                    (
                        ($connected_user->role->type === UserRole::ADMIN) ||
                        ($connected_user->role->type === UserRole::SUPER_ADMIN)
                    )
                ) ||
                (
                    ($this->role->type === UserRole::ADMIN) &&
                    ($connected_user->role->type === UserRole::SUPER_ADMIN)
                )
            )
        );
    }
}