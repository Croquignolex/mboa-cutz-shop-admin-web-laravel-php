<?php

namespace App\Traits;

use App\Models\Tag;
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

    /**
     * Map tag data to fit sync method
     *
     * @param array $tags
     * @return mixed
     */
    public function mapTags(array $tags) {
        return collect($tags)->map(function ($tag) {
            $tagModel = Tag::whereSlug($tag)->first();
           return $tagModel !== null ? $tagModel->id : 0;
        });
    }
}