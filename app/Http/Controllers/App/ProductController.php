<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Traits\ModelMapping;
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

class ProductController extends Controller
{
    use ModelMapping;

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
        $products = Product::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.products.create');
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
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Product $product)
    {
        return view('app.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Product $product)
    {
        $categories = $this->mapModels(Category::all());
        $tags = $this->mapModels(Tag::all());

        return view('app.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Product $product)
    {
        dd($request->tags);
        $product->update($request->all());

        success_toast_alert("Produit $product->fr_name mise à jour avec success");
        log_activity("Produit", "Mise à jour du produit $product->fr_name");

        return redirect(route('products.show', compact('product')));
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        if(!$product->can_delete) return $this->unauthorizedToast();

        $product->delete();

        success_toast_alert("Produit $product->fr_name archivé avec success");
        log_activity("Produit", "Archivage du produit $product->fr_name");

        return redirect(route('products.index'));
    }

    /**
     * Update product image
     *
     * @param Base64ImageRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function updateImage(Base64ImageRequest $request, Product $product) {
        // Get current product
        $product_image_src = $product->image_src;

        //Delete old file before storing new file
        if(Storage::exists($product_image_src) && $product->image !== Constants::DEFAULT_IMAGE)
            Storage::delete($product_image_src);

        // Convert base 64 image to normal image for the server and the data base
        $product_image_to_save = imageFromBase64AndSave($request->input('base_64_image'), ImagePath::PRODUCT_DEFAULT_IMAGE_PATH);

        // Save image name in database
        $product->update([
            'image' => $product_image_to_save['name'],
            'image_extension' => $product_image_to_save['extension'],
        ]);

        log_activity("Produit", "Mise à jour de la photo du produit $product->fr_name");
        return response()->json(['message' => "Photo du produit $product->fr_name mise à jour avec succès"]);
    }
}