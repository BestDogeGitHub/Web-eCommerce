<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductTypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category as Category;
use App\ProductType as ProductType;
use App\Product as Product;
use App\Producer;

class ShopController extends Controller
{
    /**
     * Show the list of products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Auth::user()->assignRole('Administrator');

        $rankProducts = $this->getTopProductTypes();
        $partners = Producer::all()->random(6);
        //$topCategories = $this->getTopCategories();
 
        return view('frontoffice.pages.home', ['rankProducts' => $rankProducts, 'partners' => $partners]);
    }

    /**
     * Show the list of products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getShop()
    {
        $products = ProductType::paginate(12);

        return view('frontoffice.pages.shop', ['products' => $products]);
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

        $cat_par = Category::findOrFail($parent);
        
        return view('frontoffice.pages.categories', ['categories' => $categories, 'parent' => $cat_par]);
    }

    /**
     * Restituisce il catalogo dei prodotti (producttypes) 
     * presa in input una categoria foglia
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCatalogoCategory($category) {
        $cat = Category::findOrFail($category);
        $prods = $cat->productTypes->pluck('id');
        $products = ProductType::whereIn('id', $prods)->paginate(8);

        // Manipolazione dei prodotti !!!
        $products->map(function ($product) {

        });;

        return view('frontoffice.pages.shop', ['products' => $products, 'parent' => $cat]);
    }

    /**
     * Restituisce una vista con i prodotti di quel producttype
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProductsFromType($type) {

        // Get product Type
        $productType = ProductType::findOrFail($type);
        
        // Get product from type
        $products = $productType->products()->paginate(8);

        // Get first category of product
        $category = $productType->categories->first();

        // Manipulate product
        $products->map(function ($product) {
            $product->payment = number_format((float)$product->payment, 2, '.', '');
    
            return $product;
        });;


        

        return view('frontoffice.pages.products', ['products' => $products, 'type' => $productType->name, 'category' => $category]);
    }

    

    /**
     * Restituisce i prodotti più venduti
     * 
     * @return 
     */
    private function getTopProductTypes() {
        return Product::all()->random(8);
    }

    /**
     * Restituisce le categorie più cliccate
     * 
     * @return 
     */
    private function getTopCategories() {
        return Category::all()->random(4);
    }

    /**
     * Effettua la ricerca di un product type
     * 
     * @param \Illuminate\Http\Request
     */
    public function searchProductTypes(Request $request)
    {
        $products = ProductTypeController::search($request->search);

        return view('frontoffice.pages.search', ['products' => $products, 'search' => $request->search]);

    }
}
