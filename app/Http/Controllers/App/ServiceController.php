<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Service;
use App\Models\Product;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Base64ImageRequest;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Contracts\Foundation\Application;

class ServiceController extends Controller
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
        $services = Service::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TestimonialRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(TestimonialRequest $request)
    {
        $testimonial = Auth::user()->created_testimonials()->create($request->all());

        $name = $request->input('name');
        success_toast_alert("Témoignage de $name créer avec succès");
        log_activity("Témoignage", "Création du témoignage de $name");

        return redirect(route('testimonials.show', compact('testimonial')));
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Application|Factory|Response|View
     */
    public function show(Service $service)
    {
        return view('app.services.show', compact('service'));
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
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Service $service)
    {
        if(!$service->can_delete) return $this->unauthorizedToast();

        $service->delete();

        success_toast_alert("Service $service->fr_name archivé avec success");
        log_activity("Service", "Archivage du service $service->fr_name");

        return redirect(route('services.index'));
    }

    /**
     * Update product image
     *
     * @param Base64ImageRequest $request
     * @param Service $service
     * @return JsonResponse
     */
    public function updateImage(Base64ImageRequest $request, Service $service) {
        // Get current product
        $service_image_src = $service->image_src;

        //Delete old file before storing new file
        if(Storage::exists($service_image_src) && $service->image !== Constants::DEFAULT_IMAGE)
            Storage::delete($service_image_src);

        // Convert base 64 image to normal image for the server and the data base
        $service_image_to_save = imageFromBase64AndSave($request->input('base_64_image'), ImagePath::SERVICE_DEFAULT_IMAGE_PATH);

        // Save image name in database
        $service->update([
            'image' => $service_image_to_save['name'],
            'image_extension' => $service_image_to_save['extension'],
        ]);

        log_activity("Service", "Mise à jour de la photo du service $service->fr_name");
        return response()->json(['message' => "Photo du service $service->fr_name mise à jour avec succès"]);
    }
}