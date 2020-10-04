<?php

namespace App\Http\Controllers\Archive;

use App\Models\Product;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ProductController extends Controller
{
    /**
     * TestimonialController constructor.
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
        $products = Product::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.products', compact('products'));
    }

    /**
     * @param String $product
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(String $product)
    {
        $trashed_product = Product::withTrashed()->whereSlug($product)->first();
        $trashed_product->restore();

        success_toast_alert("Produit $trashed_product->fr_name restoré avec success");
        log_activity("Produit", "Restoration du produit $trashed_product->fr_name");

        return redirect(route('archives.products.index'));
    }
}