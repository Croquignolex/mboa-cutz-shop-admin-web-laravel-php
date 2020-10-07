<?php

namespace App\Http\Controllers\Archive;

use App\Models\Service;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ServiceController extends Controller
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
        $services = Service::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.services', compact('services'));
    }

    /**
     * @param String $service
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(String $service)
    {
        $trashed_service = Service::withTrashed()->whereSlug($service)->first();
        $trashed_service->restore();

        success_toast_alert("Service $trashed_service->fr_name restoré avec success");
        log_activity("Service", "Restoration du service $trashed_service->fr_name");

        return redirect(route('archives.services.index'));
    }
}