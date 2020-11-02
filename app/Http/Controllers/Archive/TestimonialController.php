<?php

namespace App\Http\Controllers\Archive;

use App\Enums\Constants;
use Illuminate\View\View;
use App\Models\Testimonial;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.testimonials', compact('testimonials'));
    }

    /**
     * @param Int $testimonial
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(Int $testimonial)
    {
        $trashed_testimonial = Testimonial::withTrashed()->where('id', $testimonial)->first();
        if(!$trashed_testimonial->can_delete) return $this->unauthorizedToast();

        $trashed_testimonial->restore();

        success_toast_alert("Témoignage de $trashed_testimonial->name restoré avec success");
        log_activity("Témoignage", "Restoration du témoignage de $trashed_testimonial->name");

        return redirect(route('archives.testimonials.index'));
    }
}