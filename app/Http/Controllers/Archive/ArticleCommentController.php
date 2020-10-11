<?php

namespace App\Http\Controllers\Archive;

use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Models\ArticleComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ArticleCommentController extends Controller
{
    /**
     * ArticleCommentController constructor.
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
        $comments = ArticleComment::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.article-comments', compact('comments'));
    }

    /**
     * @param Int $comment
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(Int $comment)
    {
        $trashed_article_comment = ArticleComment::withTrashed()->where('id', $comment)->first();
        $trashed_article_comment->restore();
        $article = $trashed_article_comment->article;

        success_toast_alert("Commentaire sur l'article $article->fr_name restoré avec success");
        log_activity("Commentaire", "Restoration du commentaire sur l'article $article->fr_name");

        return redirect(route('archives.article-comments.index'));
    }
}