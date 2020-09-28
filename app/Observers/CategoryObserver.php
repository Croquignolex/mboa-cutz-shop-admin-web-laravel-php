<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param Category $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->slug = $category->fr_name;
    }
}
