<?php

namespace App\Http\Controllers\App;

use App\Models\Article;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ProductController extends Controller
{
    /**
     * ProductsController constructor.
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
        return view('app.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        // TODO: store
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Article $article
     * @return Application|Factory|Response|View
     */
    public function show(Request $request, Article $article)
    {
        return view('app.products.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Article $article
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Request $request, Article $article)
    {
        return view('app.products.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Article $article)
    {
        // TODO: store
        return redirect(route('products.edit', compact('article')));
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return Application|Factory|View
     */
    public function destroy(Request $request, Article $article)
    {
        // TODO: delete
        return redirect(route('products.index'));
    }
}