<?php

namespace App\Models;

use App\Enums\Constants;
use App\Enums\UserRole;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use App\Enums\ProductAvailability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed image
 * @property mixed image_extension
 * @property mixed stock
 * @property mixed is_new
 * @property mixed fr_name
 * @property mixed slug
 * @property mixed en_name
 * @property mixed fr_description
 * @property mixed en_description
 * @property mixed created_at
 * @property mixed discount
 * @property mixed creator
 * @property mixed price
 */
class Product extends Model
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
        'image', 'fr_name', 'en_name', 'fr_description', 'en_description',
        'price', 'discount', 'ranking', 'stock', 'extension',
        'is_featured', 'is_new', 'is_most_sold',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Product image src
     *
     * @return string
     */
    public function getImageSrcAttribute() {
        // Update une avatar with default if avatar file is not found
        if(!Storage::exists(product_img_asset($this->image, $this->image_extension))) {
            $this->update([
                'image' => Constants::DEFAULT_IMAGE,
                'image_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return product_img_asset($this->image, $this->image_extension);
    }

    /**
     * Product availability tag
     *
     * @return mixed
     */
    public function getAvailabilityAttribute()
    {
        if($this->stock <= 0) return ProductAvailability::OUT_OF_STOCK;
        else return ProductAvailability::IN_STOCk;
    }

    /**
     * Product duration tag
     *
     * @return bool
     */
    public function getIsANewAttribute()
    {
        return ($this->is_new) || ($this->created_at >= now()->subDays(-7));
    }

    /**
     * Products discount tag
     *
     * @return bool
     */
    public function getIsADiscountAttribute()
    {
        return $this->discount !== 0;
    }

    /**
     * Check if product can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        $connected_user = Auth::user();
        return (
            ($connected_user->role->type === UserRole::SUPER_ADMIN) ||
            ($this->creator === null) ||
            (Auth::user()->id === $this->creator->id)
        );
    }
}