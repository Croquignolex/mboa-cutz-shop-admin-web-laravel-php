<?php

namespace App\Http\Controllers\Archive;

use App\Models\Picture;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class PictureController extends Controller
{
    /**
     * PictureController constructor.
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
        $pictures = Picture::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.pictures', compact('pictures'));
    }

    /**
     * @param Int $picture
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(Int $picture)
    {
        $trashed_picture = Picture::withTrashed()->where('id', $picture)->first();
        if(!$trashed_picture->can_delete) return $this->unauthorizedToast();

        $trashed_picture->restore();

        $name = text_format($trashed_picture->fr_description, 30);
        success_toast_alert("Image avec la description $name restorée avec success");
        log_activity("Gallery", "Restoration  de l'image avec la description $name");

        return redirect(route('archives.pictures.index'));
    }
}