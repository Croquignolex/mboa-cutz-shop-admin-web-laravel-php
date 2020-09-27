<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\User;

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
