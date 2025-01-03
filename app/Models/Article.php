<?php

namespace App\Models;

use App\Enums\Constants;
use App\Enums\ImagePath;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SuperAdminOrCreatorCanDeleteTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed image
 * @property mixed is_new
 * @property mixed created_at
 * @property mixed image_extension
 * @property mixed creator
 * @property mixed fr_name
 * @property mixed en_name
 * @property mixed slug
 * @property mixed tags
 * @property mixed category
 * @property mixed image_src
 * @property mixed can_delete
 * @property mixed comments
 */
class Article extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait, SuperAdminOrCreatorCanDeleteTrait;

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
        'fr_name', 'en_name', 'fr_description', 'en_description',
        'is_featured', 'is_new',
        'image', 'extension'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_new' => 'boolean',
        'is_featured' => 'boolean',
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
        $folder = ImagePath::ARTICLE_DEFAULT_IMAGE_PATH;
        if(!Storage::disk('public')->exists("$folder/$this->image.$this->image_extension")) {
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
        return (
            (($this->comments->count() === 0)) &&
            $this->superAdminOrCreatorCanDelete()
        );
    }
}