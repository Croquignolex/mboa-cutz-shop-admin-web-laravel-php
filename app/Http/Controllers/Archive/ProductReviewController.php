<?php

namespace App\Http\Controllers\Archive;

use App\Enums\Constants;
use Illuminate\View\View;
use App\Models\ProductReview;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ProductReviewController extends Controller
{
    /**
     * ProductReviewController constructor.
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
        $reviews = ProductReview::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.product-reviews', compact('reviews'));
    }

    /**
     * @param Int $review
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(Int $review)
    {
        $trashed_product_review = ProductReview::withTrashed()->where('id', $review)->first();
        $trashed_product_review->restore();
        $product = $trashed_product_review->product;

        success_toast_alert("Commentaire sur le produit $product->fr_name restoré avec success");
        log_activity("Commentaire", "Restoration du commentaire sur le produit $product->fr_name");

        return redirect(route('archives.product-reviews.index'));
    }
}