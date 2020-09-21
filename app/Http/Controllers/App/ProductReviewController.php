<?php

namespace App\Http\Controllers\App;

use App\Models\Review;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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
     * @param Request $request
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function index(Request $request, Product $product)
    {
        return view('app.products.reviews.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function create(Request $request, Product $product)
    {
        return view('app.products.reviews.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request, Product $product)
    {
        // TODO: store
        return redirect(route('products.reviews.index', compact('product')));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Review $review
     * @return Application|Factory|Response|View
     */
    public function show(Request $request, Review $review)
    {
        return view('app.products.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Review $review
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Request $request, Review $review)
    {
        return view('app.products.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Review $review
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Review $review)
    {
        // TODO: store
        return redirect(route('products.reviews.edit', compact('review')));
    }

    /**
     * @param Request $request
     * @param Review $review
     * @return Application|Factory|View
     */
    public function destroy(Request $request, Review $review)
    {
        // TODO: delete
        $product = $review->product;
        return redirect(route('products.reviews.index', compact('product')));
    }
}