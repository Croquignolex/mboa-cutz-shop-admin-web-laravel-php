<?php

namespace App\Http\Controllers\Archive;

use App\Models\Tag;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class TagController extends Controller
{
    /**
     * TagController constructor.
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
        $tags = Tag::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.tags', compact('tags'));
    }

    /**
     * @param String $tag
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(String $tag)
    {
        $trashed_tag = Tag::withTrashed()->whereSlug($tag)->first();
        if(!$trashed_tag->can_delete) return $this->unauthorizedToast();

        $trashed_tag->restore();

        success_toast_alert("Etiquette $trashed_tag->fr_name restoré avec success");
        log_activity("Etiquette", "Restoration de l'étiquette $trashed_tag->fr_name");

        return redirect(route('archives.tags.index'));
    }
}