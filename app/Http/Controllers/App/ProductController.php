<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Enums\ImagePath;
use App\Enums\Constants;
use Illuminate\View\View;
use App\Traits\ProductStore;
use App\Traits\ModelMapping;
use App\Models\ProductReview;
use Illuminate\Http\Response;
use App\Traits\ModelRatingTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Base64ImageRequest;
use Illuminate\Contracts\Foundation\Application;

class ProductController extends Controller
{
    use ModelMapping, ProductStore, ModelRatingTrait;

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
        $tags = $this->mapModels(Tag::all());
        $categories = $this->mapModels(Category::all());

        return view('app.products.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(ProductRequest $request)
    {
        $tags = $request->input('tags');

        $product = $this->productStore(
            $request,
            Category::whereSlug($request->input('category'))->first(),
            ($tags !== null) ? $this->mapTags($tags) : collect()
        );

        return redirect(route('products.show', compact('product')));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Product $product)
    {
        $reviews = $product
            ->reviews()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.products.show', compact('product', 'reviews'));
    }

    /**
     * Remove product review
     *
     * @param Product $product
     * @param ProductReview $review
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function removeReview(Product $product, ProductReview $review) {
        if(!$review->can_delete) return $this->unauthorizedToast();

        $review->delete();

        $this->rateModel($product);

        success_toast_alert("Commentaire sur le produit $product->fr_name archivé avec success");
        log_activity("Commentaire", "Archivage du commentaire sur le produit $product->fr_name");

        return redirect(route('products.show', compact('product')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Product $product)
    {
        $tags = $this->mapModels(Tag::all());
        $categories = $this->mapModels(Category::all());
        $selectedTags = $product->tags->map(function (Tag $tag) {
            return $tag->slug;
        });

        return view('app.products.edit', compact('product', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),

            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'discount' => $request->input('discount'),

            'is_new' => $request->input('new') !== null,
            'is_featured' => $request->input('featured') !== null,
            'is_most_sold' => $request->input('most_sold') !== null,
        ]);

        $tags = $request->input('tags');
        $category = $request->input('category');

        if($tags !== null) $product->tags()->sync($this->mapTags($tags));
        else $product->tags()->detach();

        if($product->category->slug !== $category) {
            $product->category()->associate(Category::whereSlug($category)->first());
            $product->save();
        }

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