<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ProductStore
{
    /**
     * Manage product storing process
     *
     * @param Request $request
     * @param Category $category
     */
    public function productStore(Request $request, Category $category) {
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

        $tags = $request->input('tags');

        if($tags !== null) $product->tags()->sync($this->mapTags($tags));
        $product->creator()->associate(Auth::user());
        $product->save();

        success_toast_alert("Produit $product->fr_name créer avec succès");
        log_activity("Produit", "Création du produit $product->fr_name");

        return $product;
    }
}