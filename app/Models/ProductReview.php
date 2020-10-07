<?php

namespace App\Models;

use App\Traits\DateTrait;
use App\Traits\CreatorTrait;
use App\Traits\SuperAdminCanDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed id
 */
class ProductReview extends Model
{
    use SoftDeletes, DateTrait, CreatorTrait, SuperAdminCanDelete;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $guarded = ['id', 'creator_id', 'product_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'rate'];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}