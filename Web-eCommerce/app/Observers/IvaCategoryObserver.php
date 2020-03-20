<?php

namespace App\Observers;

use App\IvaCategory;
use Illuminate\Support\Facades\DB;
use App\Product;

class IvaCategoryObserver
{
    /**
     * Handle the iva category "updated" event.
     *
     * @param  \App\IvaCategory  $ivaCategory
     * @return void
     */
    public function updating(IvaCategory $ivaCategory)
    {
        if($ivaCategory->isDirty('value'))// value has changed
        {
            $newIva = $ivaCategory->value; 
            $oldIva = $ivaCategory->getOriginal('value');

            $products = DB::table('products')->where('iva_category_id', '=', $ivaCategory->id)->get();

            foreach ($products as $product) 
            {
                $newPrice = ( ( 100 + $newIva )/( 100 + $oldIva ) ) * $product->payment;

                DB::table('products')->where('id', $product->id)->update(['payment' => $newPrice]);
            }
        }
    }
}
