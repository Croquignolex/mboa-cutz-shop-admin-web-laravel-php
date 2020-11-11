<?php

namespace App\Models;

use App\Enums\ImagePath;
use App\Enums\Constants;
use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SuperAdminOrCreatorCanDeleteTrait;

/**
 * @property mixed image
 * @property mixed image_extension
 * @property mixed fr_name
 * @property mixed slug
 * @property mixed en_name
 * @property mixed can_delete
 * @property mixed fr_description
 * @property mixed en_description
 * @property mixed created_at
 * @property mixed creator
 * @property mixed image_src
 */
class Event extends Model
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
        'fr_name', 'en_name', 'fr_description', 'en_description',
        'image', 'extension',
    ];

    /**
     * Event image src
     *
     * @return string
     */
    public function getImageSrcAttribute() {
        // Update image with default if file is not found
        $folder = ImagePath::EVENT_DEFAULT_IMAGE_PATH;
        if(!Storage::disk('public')->exists("$folder/$this->image.$this->image_extension")) {
            $this->update([
                'image' => Constants::DEFAULT_IMAGE,
                'image_extension' => Constants::DEFAULT_IMAGE_EXTENSION,
            ]);
        }

        return event_img_asset($this->image, $this->image_extension);
    }

    /**
     * Check if event can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        return $this->superAdminOrCreatorCanDelete();
    }
}