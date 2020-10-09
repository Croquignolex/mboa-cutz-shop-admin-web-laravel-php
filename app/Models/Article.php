<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\Constants;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed image
 * @property mixed is_new
 * @property mixed created_at
 * @property mixed image_extension
 * @property mixed creator
 */
class Article extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $guarded = ['slug', 'id', 'creator_id', 'category_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fr_title', 'en_title', 'fr_description', 'en_description',
        'is_featured', 'is_new',
        'image', 'extension'
    ];

    /**
     * @return BelongsToMany|HasMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\ArticleComment');
    }

    /**
     * Article duration tag
     *
     * @return bool
     */
    public function getIsANewAttribute()
    {
        return ($this->is_new) || ($this->created_at >= now()->subDays(7));
    }

    /**
     * Article image src
     *
     * @return string
     */
    public function getImageSrcAttribute() {
        // Update image with default if file is not found
        if(!Storage::exists(article_img_asset($this->image, $this->image_extension))) {
            $this->update([
                'image' => Constants::DEFAULT_IMAGE,
                'image_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return article_img_asset($this->image, $this->image_extension);
    }

    /**
     * Check if article can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        //TODO: complete product can_delete(comments etc...)
        $connected_user = Auth::user();
        return (
            ($connected_user->role->type === UserRole::SUPER_ADMIN) ||
            ($this->creator === null) ||
            (Auth::user()->id === $this->creator->id)
        );
    }
}