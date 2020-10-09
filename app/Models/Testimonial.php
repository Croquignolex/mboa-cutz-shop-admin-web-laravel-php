<?php

namespace App\Models;

use App\Enums\Constants;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use App\Traits\SuperAdminOrCreatorCanDeleteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed name
 * @property mixed slug
 * @property mixed fr_description
 * @property mixed creator
 * @property mixed en_description
 * @property mixed image
 * @property mixed image_src
 * @property mixed image_extension
 */
class Testimonial extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait, SuperAdminOrCreatorCanDeleteTrait;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $guarded = ['slug', 'id', 'creator_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'fr_description', 'en_description',
        'image_extension', 'image',
    ];

    /**
     * Testimonial image src
     *
     * @return string
     */
    public function getImageSrcAttribute() {
        // Update image with default if file is not found
        if(!Storage::exists(testimonial_img_asset($this->image, $this->image_extension))) {
            $this->update([
                'image' => Constants::DEFAULT_IMAGE,
                'image_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return testimonial_img_asset($this->image, $this->image_extension);
    }

    /**
     * Check if article can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        return $this->superAdminOrCreatorCanDelete();
    }
}