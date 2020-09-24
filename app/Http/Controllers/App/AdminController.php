<?php

namespace App\Http\Controllers\App;

use App\Models\Role;
use App\Enums\UserRole;
use App\Models\Product;
use App\Enums\Constants;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class AdminController extends Controller
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
        $admins = User::where('role_id', Role::where('type', UserRole::ADMIN)->first()->id)
            ->orWhere('role_id', Role::where('type', UserRole::SUPER_ADMIN)->first()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(3)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_ITEMS);
        return view('app.admins.index', compact('admins'));
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