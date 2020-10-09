<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param Article $article
     * @return void
     */
    public function creating(Article $article)
    {
        $article->slug = $article->fr_title;
    }
}
