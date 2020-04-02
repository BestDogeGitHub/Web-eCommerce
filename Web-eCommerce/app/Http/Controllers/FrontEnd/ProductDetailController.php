<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;

class ProductDetailController extends Controller
{
    
    /**
     * Restituisce l'articolo per la pagina di dettaglio 
     */
    public function show($id) {

        $product = ProductController::getById($id);
        $related = ProductController::getRelatedById($id);
        $reviews = $product->reviews->sortByDesc('id');

        return View('frontoffice.pages.product_details', ['product' => $product, 'related' => $related, 'reviews' => $reviews]);
    }

    
}
