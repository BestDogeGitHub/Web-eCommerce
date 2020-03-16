<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category as Category;
use App\ProductType as ProductType;
use App\Product as Product;

class ShopController extends Controller
{
    /**
     * Show the list of products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontoffice.pages.home');
    }

    /**
     * Show the list of products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getShop()
    {
        return view('frontoffice.pages.shop');
    }

    /**
     * Restituisce la vista delle categorie figlie in base a quella parent
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCategoriesView($parent)
    {

        if($parent == 0) {
            $categories = Category::where('parent_id', 1)->get();
        } 
        else {
            $categories = Category::where('parent_id', $parent)->get();
        }

        /**
         * Se non esistono sottocategorie restituisce la vista dei prodotti
         * di quella categoria.
         */
        if(!$categories->count()) {
            return $this->getCatalogoCategory($parent);
        }
        
        return view('frontoffice.pages.categories', ['categories' => $categories]);
    }

    /**
     * Restituisce il catalogo dei prodotti (producttypes) 
     * presa in input una categoria foglia
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCatalogoCategory($category) {
        $cat = Category::where('id', $category)->first();
        $prods = $cat->productTypes->pluck('id');
        $products = ProductType::whereIn('id', $prods)->paginate(12);
        return view('frontoffice.pages.shop', ['products' => $products]);
    }

    /**
     * Restituisce una vista con i prodotti di quel producttype
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProductsFromType($type) {
        $productType = ProductType::where('id', $type)->first();
        $products = $productType->products;
        return view('frontoffice.pages.products', ['products' => $products]);
    }
}
