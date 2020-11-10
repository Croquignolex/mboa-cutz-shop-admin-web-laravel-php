<?php

namespace App\Models;

use App\Traits\DateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SuperAdminOrCreatorCanDeleteTrait;

/**
 * @property mixed subject
 * @property mixed can_delete
 */
class Contact extends Model
{
    use SoftDeletes, DateTrait, SuperAdminOrCreatorCanDeleteTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'is_read'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'subject', 'message'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['is_read' => 'boolean'];

    /**
     * Check if contact message can be deleted
     *
     * @return mixed
     */
    public function getCanDeleteAttribute()
    {
        return $this->superAdminOrCreatorCanDelete();
    }
}