<?php

namespace App\Http\Controllers\Archive;

use App\Models\Category;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
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
        $categories = Category::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.categories', compact('categories'));
    }

    /**
     * @param String $category
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(String $category)
    {
        $trashed_category = Category::withTrashed()->whereSlug($category)->first();
        if(!$trashed_category->can_delete) return $this->unauthorizedToast();

        $trashed_category->restore();

        success_toast_alert("Catégorie $trashed_category->fr_name restoré avec success");
        log_activity("Catégorie", "Restoration de la categorie $trashed_category->fr_name");

        return redirect(route('archives.categories.index'));
    }
}