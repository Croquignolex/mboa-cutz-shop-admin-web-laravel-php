<?php

namespace App\Models;

use App\Enums\Constants;
use App\Traits\SlugRouteTrait;
use App\Enums\ProductAvailability;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed image
 * @property mixed image_extension
 * @property mixed stock
 * @property mixed is_new
 * @property mixed created_at
 * @property mixed discount
 * @property mixed price
 */
class Product extends Model
{
    use SoftDeletes, SlugRouteTrait, LocaleSlugSaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'fr_name', 'en_name', 'fr_description', 'en_description',
        'price', 'discount', 'ranking', 'is_featured', 'is_new', 'is_activated',
        'is_most_sold', 'stock', 'extension', 'product_category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['is_activated'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['is_activated' => 'boolean'];

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
        if(!file_exists(product_img_asset($this->image, $this->image_extension))) {
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
     * @return bool
     */
    public function getIsADiscountAttribute()
    {
        return $this->discount !== 0;
    }
}