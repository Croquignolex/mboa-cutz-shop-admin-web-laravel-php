<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait ServiceStore
{
    /**
     * Manage product storing process
     *
     * @param Request $request
     * @param Category $category
     * @param Collection $tagsID
     * @return Model
     */
    public function serviceStore(Request $request, Category $category, Collection $tagsID) {
        $service = $category->services()->create([
            'fr_name' => $request->input('fr_name'),
            'en_name' => $request->input('en_name'),
            'fr_description' => $request->input('fr_description'),
            'en_description' => $request->input('en_description'),

            'price' => $request->input('price'),
            'discount' => $request->input('discount'),

            'is_featured' => $request->input('featured') !== null,
            'is_most_asked' => $request->input('most_asked') !== null,
        ]);

        if(count($tagsID) > 0) $service->tags()->sync($tagsID);
        $service->creator()->associate(Auth::user());
        $service->save();

        success_toast_alert("Service $service->fr_name créer avec succès");
        log_activity("Service", "Création du service $service->fr_name");

        return $service;
    }
}