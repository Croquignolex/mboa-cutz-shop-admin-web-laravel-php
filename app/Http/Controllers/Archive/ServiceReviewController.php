<?php

namespace App\Http\Controllers\Archive;

use App\Enums\Constants;
use Illuminate\View\View;
use App\Models\ServiceReview;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ServiceReviewController extends Controller
{
    /**
     * ServiceReviewController constructor.
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
        $reviews = ServiceReview::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.service-reviews', compact('reviews'));
    }

    /**
     * @param Int $review
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(Int $review)
    {
        $trashed_service_review = ServiceReview::withTrashed()->where('id', $review)->first();
        $trashed_service_review->restore();
        $service = $trashed_service_review->service;

        success_toast_alert("Commentaire sur le service $service->fr_name restoré avec success");
        log_activity("Commentaire", "Restoration du commentaire sur le service $service->fr_name");

        return redirect(route('archives.service-reviews.index'));
    }
}