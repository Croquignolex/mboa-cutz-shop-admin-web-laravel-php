<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Tag;
use App\Enums\Constants;
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

class TagController extends Controller
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
        $tags = Tag::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CategoryRequest $request)
    {
        $tag = Auth::user()->created_tags()->create($request->all());

        $name = $request->input('fr_name');
        success_toast_alert("Etiquette $name créer avec succès");
        log_activity("Etiquette", "Création de l'étiquette $name");

        return redirect(route('tags.show', compact('tag')));
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|Response|View
     */
    public function show(Tag $tag)
    {
        $products = $tag
            ->products()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        $services = $tag
            ->services()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.tags.show', compact('tag', 'products', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Tag $tag)
    {
        return view('app.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());

        success_toast_alert("Etiquette $tag->fr_name mise à jour avec success");
        log_activity("Etiquette", "Mise à jour de l'étiquette $tag->fr_name");

        return redirect(route('tags.show', compact('tag')));
    }

    /**
     * @param Tag $tag
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {
        if(!$tag->can_delete) return $this->unauthorizedToast();

        $tag->delete();

        success_toast_alert("Etiquette $tag->fr_name archivés avec success");
        log_activity("Etiquette", "Archivage de l'étiquette $tag->fr_name");

        return redirect(route('tags.index'));
    }
}