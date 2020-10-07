<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Tag;
use App\Enums\Constants;
use App\Models\Category;
use Illuminate\View\View;
use App\Traits\ProductStore;
use App\Traits\ModelMapping;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\CategoryAddProductRequest;
use Illuminate\Contracts\Foundation\Application;

class CategoryController extends Controller
{
    use ModelMapping, ProductStore;

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
        $category = Auth::user()->created_categories()->create($request->all());

        $name = $request->input('fr_name');
        success_toast_alert("Catégorie $name créer avec succès");
        log_activity("Catégorie", "Création de la catégorie $name");

        return redirect(route('categories.show', compact('category')));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|Response|View
     */
    public function show(Category $category)
    {
        $products = $category
            ->products()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        $services = $category
            ->services()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        $tags = $this->mapModels(Tag::all());

        $categories = $this->mapModels(Category::all());

        return view('app.categories.show', compact('category', 'products', 'services', 'tags', 'categories'));
    }

    /**
     * Add product
     *
     * @param CategoryAddProductRequest $request
     * @param Category $category
     * @return Application|RedirectResponse|Redirector
     */
    public function addProduct(CategoryAddProductRequest $request, Category $category)
    {
        $this->productStore($request, $category);

        return redirect(route('categories.show', compact('category')));
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
     * @param CategoryRequest $request
     * @param Category $category
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        success_toast_alert("Catégorie $category->fr_name mise à jour avec success");
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

        success_toast_alert("Catégorie $category->fr_name archivée avec success");
        log_activity("Catégorie", "Archivage de la catégorie $category->fr_name");

        return redirect(route('categories.index'));
    }
}