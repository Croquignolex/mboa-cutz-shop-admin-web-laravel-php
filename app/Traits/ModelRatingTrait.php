<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait ModelRatingTrait
{
    /**
     * Rate the given model & save
     *
     * @param Model $model
     */
    public function rateModel(Model $model)
    {
        $reviewsNumber = $model->reviews->count();

        if($reviewsNumber > 0) {
            $reviewsRates = $model->reviews->sum('rate');
            $model->update(['rate' => floor($reviewsRates / $reviewsNumber)]);
        } else {
            $model->update(['rate' => 0]);
        }
    }
}