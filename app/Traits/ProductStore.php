<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait ProductStore
{
    /**
     * Manage product storing process
     *
     * @param Request $request
     * @param Category $category
     * @param Collection $tagsID
     * @return Model
     */
    public function productStore(Request $request, Category $category, Collection $tagsID) {
        $product = $category->products()->create([
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),

            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'discount' => $request->input('discount'),

            'is_featured' => $request->input('featured') !== null,
            'is_most_sold' => $request->input('most_sold') !== null,
        ]);

        if($tagsID->count() > 0) $product->tags()->sync($tagsID);
        $product->creator()->associate(Auth::user());
        $product->save();

        success_toast_alert("Produit $product->fr_name créer avec succès");
        log_activity("Produit", "Création du produit $product->fr_name");

        return $product;
    }
}