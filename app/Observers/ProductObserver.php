<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = $product->fr_name;
    }
}
