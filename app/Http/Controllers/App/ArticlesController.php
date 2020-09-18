<?php

namespace App\Http\Controllers\App;

use App\Models\Article;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ArticlesController extends Controller
{
    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('app.articles.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('app.articles.create');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        // TODO: store
        return redirect(route('articles.index'));
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return Application|Factory|View
     */
    public function show(Request $request, Article $article)
    {
        return view('app.articles.show', compact('article'));
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return Application|Factory|View
     */
    public function edit(Request $request, Article $article)
    {
        // TODO: edit
        return redirect(route('articles.show'));
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return Application|Factory|View
     */
    public function delete(Request $request, Article $article)
    {
        // TODO: delete
        return redirect(route('articles.index'));
    }

}