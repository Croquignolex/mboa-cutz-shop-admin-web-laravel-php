<?php

namespace App\Http\Controllers\App;

use App\Models\ArticleComment;
use Exception;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Product;
use App\Models\Category;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Traits\ArticleStore;
use App\Traits\ModelMapping;
use App\Models\ProductReview;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Base64ImageRequest;
use Illuminate\Contracts\Foundation\Application;

class ArticleController extends Controller
{
    use ModelMapping, ArticleStore;

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
        $articles = Article::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $tags = $this->mapModels(Tag::all());
        $categories = $this->mapModels(Category::all());

        return view('app.articles.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(ArticleRequest $request)
    {
        $tags = $request->input('tags');

        $article = $this->articleStore(
            $request,
            Category::whereSlug($request->input('category'))->first(),
            ($tags !== null) ? $this->mapTags($tags) : collect()
        );

        return redirect(route('articles.show', compact('article')));
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Application|Factory|Response|View
     */
    public function show(Article $article)
    {
        $comments = $article
            ->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.articles.show', compact('article', 'comments'));
    }

    /**
     * Remove product review
     *
     * @param Article $article
     * @param ArticleComment $comment
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function removeComment(Article $article, ArticleComment $comment) {
        if(!$comment->can_delete) return $this->unauthorizedToast();

        $comment->delete();

        success_toast_alert("Commentaire sur l'article $article->fr_name archivé avec success");
        log_activity("Commentaire", "Archivage du commentaire sur l'article $article->fr_name");

        return redirect(route('articles.show', compact('article')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Article $article)
    {
        $tags = $this->mapModels(Tag::all());
        $categories = $this->mapModels(Category::all());
        $selectedTags = $article->tags->map(function (Tag $tag) {
            return $tag->slug;
        });

        return view('app.articles.edit', compact('article', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update([
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),

            'is_new' => $request->input('new') !== null,
            'is_featured' => $request->input('featured') !== null,
        ]);

        $tags = $request->input('tags');
        $category = $request->input('category');

        if($tags !== null) $article->tags()->sync($this->mapTags($tags));
        else $article->tags()->detach();

        if($article->category->slug !== $category) {
            $article->category()->associate(Category::whereSlug($category)->first());
            $article->save();
        }

        success_toast_alert("Article $article->fr_name mise à jour avec success");
        log_activity("Article", "Mise à jour de l'article $article->fr_name");

        return redirect(route('articles.show', compact('article')));
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Article $article)
    {
        if(!$article->can_delete) return $this->unauthorizedToast();

        $article->delete();

        success_toast_alert("Article $article->fr_name archivé avec success");
        log_activity("Article", "Archivage de l'article $article->fr_name");

        return redirect(route('articles.index'));
    }

    /**
     * Update product image
     *
     * @param Base64ImageRequest $request
     * @param Article $article
     * @return JsonResponse
     */
    public function updateImage(Base64ImageRequest $request, Article $article) {
        // Get current article
        $article_image_src = $article->image_src;

        //Delete old file before storing new file
        if(Storage::exists($article_image_src) && $article->image !== Constants::DEFAULT_IMAGE)
            Storage::delete($article_image_src);

        // Convert base 64 image to normal image for the server and the data base
        $article_image_to_save = imageFromBase64AndSave($request->input('base_64_image'), ImagePath::ARTICLE_DEFAULT_IMAGE_PATH);

        // Save image name in database
        $article->update([
            'image' => $article_image_to_save['name'],
            'image_extension' => $article_image_to_save['extension'],
        ]);

        log_activity("Article", "Mise à jour de la photo de l'article $article->fr_name");
        return response()->json(['message' => "Photo de l'article $article->fr_name mise à jour avec succès"]);
    }
}