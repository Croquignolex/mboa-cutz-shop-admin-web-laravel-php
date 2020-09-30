<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Contracts\Foundation\Application;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TestimonialRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(TestimonialRequest $request)
    {
        Auth::user()->created_testimonials()->create($request->all());

        $name = $request->input('name');
        success_toast_alert("Témoignage de $name créer avec succès");
        log_activity("Témoignage", "Création du témoignage de $name");

        return redirect(route('testimonials.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Testimonial $testimonial
     * @return Application|Factory|Response|View
     */
    public function show(Testimonial $testimonial)
    {
        return view('app.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Testimonial $testimonial
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Testimonial $testimonial)
    {
        return view('app.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Testimonial $testimonial
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($request->all());

        success_toast_alert("Témoignage de $testimonial->name mise à jour avec success");
        log_activity("Témoignage", "Mise à jour du témoignage de $testimonial->fname");

        return redirect(route('testimonials.show', compact('testimonial')));
    }

    /**
     * @param Testimonial $testimonial
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        success_toast_alert("Témoignage $testimonial->name archivée avec success");
        log_activity("Témoignage", "Archivage du témoignage de $testimonial->name");

        return redirect(route('testimonials.index'));
    }
}