<?php

namespace App\Observers;

use App\Product;

class ProductObserver
{
    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }
}
