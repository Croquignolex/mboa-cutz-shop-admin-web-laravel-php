<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait ModelMapping
{
    /**
     * Map model data to fit into select
     *
     * @param Collection $models
     * @return Collection|\Illuminate\Support\Collection
     */
    public function mapModels(Collection $models)
    {
        return $models->map(function ($model) {
            return [
                "value" => $model->slug,
                "label" => $model->fr_name,
                'class' => ""
            ];
        });
    }
}