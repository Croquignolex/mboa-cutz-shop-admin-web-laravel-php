<?php

namespace App\Models;

use App\Enums\ImagePath;
use App\Enums\Constants;
use App\Traits\DateTrait;
use App\Traits\OfferTrait;
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
 * @property mixed image_extension
 * @property mixed stock
 * @property mixed is_new
 * @property mixed fr_name
 * @property mixed slug
 * @property mixed en_name
 * @property mixed can_delete
 * @property mixed fr_description
 * @property mixed en_description
 * @property mixed created_at
 * @property mixed discount
 * @property mixed creator
 * @property mixed price
 * @property mixed tags
 * @property mixed category
 * @property mixed image_src
 * @property mixed reviews
 */
class Service extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait, OfferTrait, SuperAdminOrCreatorCanDeleteTrait;

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
        'is_featured', 'is_new', 'is_most_asked',
        'rate', 'price', 'discount',
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
    public function reviews()
    {
        return $this->hasMany('App\Models\ServiceReview');
    }

    /**
     * Product image src
     *
     * @return string
     */
    public function getImageSrcAttribute() {
        // Update image with default if file is not found
        $folder = ImagePath::SERVICE_DEFAULT_IMAGE_PATH;
        if(!Storage::disk('public')->exists("$folder/$this->image.$this->image_extension")) {
            $this->update([
                'image' => Constants::DEFAULT_IMAGE,
                'image_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return service_img_asset($this->image, $this->image_extension);
    }

    /**
     * Check if service can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        //TODO: complete product can_delete(commands)
        return (
            (($this->reviews->count() === 0)) &&
            $this->superAdminOrCreatorCanDelete()
        );
    }
}