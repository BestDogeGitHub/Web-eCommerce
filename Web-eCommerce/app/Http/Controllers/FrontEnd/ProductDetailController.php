<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarrierController;

class ProductDetailController extends Controller
{
    
    /**
     * Restituisce l'articolo per la pagina di dettaglio 
     */
    public function show($id) {

        $product = ProductController::getById($id);

        return View('frontoffice.pages.product_details', ['product' => $product]);
    }

    public function showCarrier($idCarrier) {

        $carrier = CarrierController::getById($idCarrier);

        return View('frontoffice.pages.carrier_detail', ['carrier' => $carrier]);
    }
}
