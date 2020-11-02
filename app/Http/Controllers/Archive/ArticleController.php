<?php

namespace App\Http\Controllers\Archive;

use App\Models\Article;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $articles = Article::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.articles', compact('articles'));
    }

    /**
     * @param String $article
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(String $article)
    {
        $trashed_article = Article::withTrashed()->whereSlug($article)->first();
        if(!$trashed_article->can_delete) return $this->unauthorizedToast();

        $trashed_article->restore();

        success_toast_alert("Article $trashed_article->fr_name restoré avec success");
        log_activity("Article", "Restoration de l'article $trashed_article->fr_name");

        return redirect(route('archives.articles.index'));
    }
}