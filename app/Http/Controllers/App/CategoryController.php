<?php

namespace App\Http\Controllers\App;

use App\Enums\Constants;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class CategoryController extends Controller
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
        $categories = Category::all()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);
//        $categories = Category::all()->sortByDesc('created_at');
        dd($categories);
        return view('app.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        $name = $request->input('fr_name');
        success_toast_alert("Catégorie $name créer avec succès");
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Request $request, Product $product)
    {
        return view('app.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Request $request, Product $product)
    {
        return view('app.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Product $product)
    {
        // TODO: store
        return redirect(route('products.edit', compact('product')));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return Application|Factory|View
     */
    public function destroy(Request $request, Product $product)
    {
        // TODO: delete
        return redirect(route('products.index'));
    }
}