<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Tag;
use App\Models\Service;
use App\Models\Category;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Traits\ServiceStore;
use App\Traits\ModelMapping;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ServiceRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Base64ImageRequest;
use Illuminate\Contracts\Foundation\Application;

class ServiceController extends Controller
{
    use ModelMapping, ServiceStore;

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
        $tags = $this->mapModels(Tag::all());
        $categories = $this->mapModels(Category::all());

        return view('app.services.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(ServiceRequest $request)
    {
        $tags = $request->input('tags');

        $service = $this->serviceStore(
            $request,
            Category::whereSlug($request->input('category'))->first(),
            ($tags !== null) ? $this->mapTags($tags) : collect()
        );

        return redirect(route('services.show', compact('service')));
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Application|Factory|Response|View
     */
    public function show(Service $service)
    {
        $reviews = $service
            ->reviews()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.services.show', compact('service', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Service $service)
    {
        $tags = $this->mapModels(Tag::all());
        $categories = $this->mapModels(Category::all());
        $selectedTags = $service->tags->map(function (Tag $tag) {
            return $tag->slug;
        });

        return view('app.services.edit', compact('service', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param Service $service
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update([
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),

            'price' => $request->input('price'),
            'discount' => $request->input('discount'),

            'is_new' => $request->input('new') !== null,
            'is_featured' => $request->input('featured') !== null,
            'is_most_asked' => $request->input('most_asked') !== null,
        ]);

        $tags = $request->input('tags');
        $category = $request->input('category');

        if($tags !== null) $service->tags()->sync($this->mapTags($tags));
        else $service->tags()->detach();

        if($service->category->slug !== $category) {
            $service->category()->associate(Category::whereSlug($category)->first());
            $service->save();
        }

        success_toast_alert("Service $service->fr_name mise à jour avec success");
        log_activity("Service", "Mise à jour du service $service->fr_name");

        return redirect(route('services.show', compact('service')));
    }

    /**
     * @param Service $service
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