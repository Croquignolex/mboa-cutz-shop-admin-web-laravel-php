<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Event;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Base64ImageRequest;
use Illuminate\Contracts\Foundation\Application;

class EventController extends Controller
{
    /**
     * EventController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only('updateImage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(EventRequest $request)
    {
        // Extract date
        $range = $request->input('range');
        $range_tab = explode(' - ', $range);
        $started_at = Carbon::createFromFormat('d M, Y à H:i', $range_tab[0], session('timezone'));
        $ended_at = Carbon::createFromFormat('d M, Y à H:i', $range_tab[1], session('timezone'));
        $started_at->setTimezone('UTC');
        $ended_at->setTimezone('UTC');

        $event = Auth::user()->created_events()->create([
            'ended_at' => $ended_at,
            'started_at' => $started_at,
            'map' => $request->input('map'),
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),
            'fr_localisation' => $request->input('fr_localisation'),
            'en_localisation' => $request->input('en_localisation'),
        ]);

        $name = $request->input('fr_name');
        success_toast_alert("Evènement $name créer avec succès");
        log_activity("Evènement", "Création de l'évènement $name");

        return redirect(route('events.show', compact('event')));
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Application|Factory|Response|View
     */
    public function show(Event $event)
    {
        return view('app.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Event $event)
    {
        return view('app.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $request
     * @param Event $event
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->all());

        success_toast_alert("Evènement $event->fr_name mis à jour avec success");
        log_activity("Evènement", "Mise à jour de l'évènement $event->fr_name");

        return redirect(route('events.show', compact('event')));
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Event $event)
    {
        if(!$event->can_delete) return $this->unauthorizedToast();

        $event->delete();

        success_toast_alert("Evènement $event->fr_name archivé avec success");
        log_activity("Evènement", "Archivage de l'évènement $event->fr_name");

        return redirect(route('events.index'));
    }

    /**
     * Update event image
     *
     * @param Base64ImageRequest $request
     * @param Event $event
     * @return JsonResponse
     */
    public function updateImage(Base64ImageRequest $request, Event $event)
    {
        // Convert base 64 image to normal image for the server and the data base
        $event_image_to_save = imageFromBase64AndSave(
            $request->input('base_64_image'),
            $event->image,
            $event->image_extension,
            ImagePath::EVENT_DEFAULT_IMAGE_PATH
        );

        // Save image name in database
        $event->update([
            'image' => $event_image_to_save['name'],
            'image_extension' => $event_image_to_save['extension'],
        ]);

        log_activity("Evènement", "Mise à jour de la photo de l'évènement de $event->fr_name");
        return response()->json(['message' => "Photo de l'évènement $event->fr_name mise à jour avec succès"]);
    }
}