<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait ArticleStore
{
    /**
     * Manage product storing process
     *
     * @param Request $request
     * @param Category $category
     * @param Collection $tagsID
     * @return Model
     */
    public function articleStore(Request $request, Category $category, Collection $tagsID) {
        $article = $category->articles()->create([
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),

            'is_featured' => $request->input('featured') !== null
        ]);

        if($tagsID->count() > 0) $article->tags()->sync($tagsID);
        $article->creator()->associate(Auth::user());
        $article->save();

        success_toast_alert("Article $article->fr_name créer avec succès");
        log_activity("Article", "Création de l'article $article->fr_name");

        return $article;
    }
}