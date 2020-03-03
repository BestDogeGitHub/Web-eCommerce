<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Product;

class ProductDetailController extends Controller
{
    
    /**
     * Restituisce l'articolo per la pagina di dettaglio 
     */
    public function show($id) {

        $product = Product::where('id', 1)->first();

        return View('pages.product_details', ['product' => $product]);
    }
}
