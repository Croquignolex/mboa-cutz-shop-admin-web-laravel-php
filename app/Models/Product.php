<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\Constants;
use App\Traits\DateTrait;
use App\Traits\OfferTrait;
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
 */
class Product extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait, OfferTrait;

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
        'is_featured', 'is_new', 'is_most_sold',
        'price', 'discount', 'stock', 'rate',
        'image', 'extension',
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
        return $this->hasMany('App\Models\ProductReview');
    }

    /**
     * Product image src
     *
     * @return string
     */
    public function getImageSrcAttribute() {
        // Update image with default if file is not found
        if(!Storage::exists(product_img_asset($this->image, $this->image_extension))) {
            $this->update([
                'image' => Constants::DEFAULT_IMAGE,
                'image_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return product_img_asset($this->image, $this->image_extension);
    }

    /**
     * Check if product can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        //TODO: complete product can_delete(commands, comments etc...)
        $connected_user = Auth::user();
        return (
            ($connected_user->role->type === UserRole::SUPER_ADMIN) ||
            ($this->creator === null) ||
            (Auth::user()->id === $this->creator->id)
        );
    }
}