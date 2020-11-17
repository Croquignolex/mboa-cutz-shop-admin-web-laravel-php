<?php

namespace App\Http\Controllers\Archive;

use App\Models\Event;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class EventController extends Controller
{
    /**
     * EventController constructor.
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
        $events = Event::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.events', compact('events'));
    }

    /**
     * @param String $event
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(String $event)
    {
        $trashed_event = Event::withTrashed()->whereSlug($event)->first();
        if(!$trashed_event->can_delete) return $this->unauthorizedToast();

        $trashed_event->restore();

        success_toast_alert("Evènement $trashed_event->fr_name restoré avec success");
        log_activity("Evènement", "Restoration de l'évènement $trashed_event->fr_name");

        return redirect(route('archives.events.index'));
    }
}