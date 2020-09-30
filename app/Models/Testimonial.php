<?php

namespace App\Models;

use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed name
 * @property mixed slug
 * @property mixed fr_description
 * @property mixed creator
 * @property mixed en_description
 */
class Testimonial extends Model
{
    use SoftDeletes, SlugRouteTrait, DateTrait, CreatorTrait;

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
    protected $fillable = ['name', 'fr_description', 'en_description'];
}