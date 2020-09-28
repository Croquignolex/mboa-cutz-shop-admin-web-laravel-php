<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Product;
use App\Enums\Constants;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
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
        $categories = Category::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
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
        Auth::user()->created_categories()->create($request->only([
            'fr_name', 'en_name', 'fr_description', 'en_description'
        ]));

        $name = $request->input('fr_name');
        success_toast_alert("Catégorie $name créer avec succès");
        log_activity("Catégorie", "Création de la catégorie $name");

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
     * @param Category $category
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Category $category)
    {
        return view('app.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->only(['fr_name', 'en_name', 'fr_decription', 'en_description']));

        success_toast_alert("Catégorie $category->fr_name mis à jour avec success");
        log_activity("Catégorie", "Mise à jour de la catégorie $category->fr_name");

        return redirect(route('categories.show', compact('category')));
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        if(!$category->can_delete) return $this->unauthorizedToast();

        $category->delete();

        success_toast_alert("Catégorie $category->fr_name archivé avec success");
        log_activity("Catégorie", "Archivage de  la catégorie $category->fr_name");

        return redirect(route('categories.index'));
    }
}