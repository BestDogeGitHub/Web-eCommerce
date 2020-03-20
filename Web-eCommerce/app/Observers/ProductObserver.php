<?php

namespace App\Observers;

use App\Product;
use App\IvaCategory;

class ProductObserver
{
    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        if($product->isDirty('stock')) // stock has changed
        {
            if( $product->stock == 0 )
            {
                $item = Product::find( $product->id );
                $item->available = 0;
                $item->save();
            }
        }
        if($product->isDirty('iva_category_id')) // iva_category_id has changed
        {
            $new_iva_category_id = $product->iva_category_id; 
            $old_iva_category_id = $product->getOriginal('iva_category_id');
            $newIva = IvaCategory::find( $new_iva_category_id );
            $oldIva = IvaCategory::find( $old_iva_category_id );

            $item = Product::find( $product->id );
            $item->payment = ( ( 100 + $newIva->value )/( 100 + $oldIva->value ) ) * $item->payment; // new price
            $item->save();
        }
    }
}
