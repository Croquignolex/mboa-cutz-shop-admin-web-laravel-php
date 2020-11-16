<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\PictureRequest;
use Exception;
use App\Models\Event;
use App\Models\Picture;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Models\Testimonial;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Base64ImageRequest;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Contracts\Foundation\Application;

class PictureController extends Controller
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
        $pictures = Picture::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.pictures.index', compact('pictures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.pictures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PictureRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(PictureRequest $request)
    {
        $picture = Auth::user()->created_pictures()->create($request->all());

        $name = text_format($request->input('fr_description'), 30);
        success_toast_alert("Image avec la description $name créer avec succès");
        log_activity("Gallery", "Création de l'image avec la description $name");

        return redirect(route('pictures.show', compact('picture')));
    }

    /**
     * Display the specified resource.
     *
     * @param Picture $picture
     * @return Application|Factory|Response|View
     */
    public function show(Picture $picture)
    {
        return view('app.pictures.show', compact('picture'));
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
     * @param TestimonialRequest $request
     * @param Testimonial $testimonial
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->all());

        success_toast_alert("Témoignage de $testimonial->name mise à jour avec success");
        log_activity("Témoignage", "Mise à jour du témoignage de $testimonial->name");

        return redirect(route('testimonials.show', compact('testimonial')));
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
            ImagePath::TESTIMONIAL_DEFAULT_IMAGE_PATH
        );

        // Save image name in database
        $event->update([
            'image' => $event_image_to_save['name'],
            'image_extension' => $event_image_to_save['extension'],
        ]);

        log_activity("Evènement", "Mise à jour de la photo de l'évènement de $event->fr_name");
        return response()->json(['message' => "Photo du témoignage de l'évènement $event->fr_name mise à jour avec succès"]);
    }
}