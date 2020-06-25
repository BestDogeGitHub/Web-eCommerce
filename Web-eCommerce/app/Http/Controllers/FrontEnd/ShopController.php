<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\CarrierController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Category;
use App\ProductType;
use App\Product;
use App\Producer;
use App\SiteImage;


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
        $testimonies = SiteImage::where('site_image_role_id', 10)->inRandomOrder()->get();
        $cat1 = SiteImage::where('site_image_role_id', 15)->first();
        $cat2 = SiteImage::where('site_image_role_id', 16)->first();
        $cat3 = SiteImage::where('site_image_role_id', 17)->first();
        $cat4 = SiteImage::where('site_image_role_id', 18)->first();
        $img_cat = SiteImage::where('site_image_role_id', 19)->first();
        

        // PARSING HTML
        $testimonies->map( function($item){

            preg_match_all ( '#<p>(.+?)</p>#', $item->image_details, $parts );

            if(count($parts[1]) != 3) {
                $item['text'] = "Error";
                $item['user'] = "Error";
                $item['man'] = "Error";
            } else {
                $item['text'] = $parts[1][0];
                $item['user'] = $parts[1][1];
                $item['man'] = $parts[1][2];
            }

            
        });



        //$topCategories = $this->getTopCategories(); 
        return view('frontoffice.pages.home', ['rankProducts' => $rankProducts, 'partners' => $partners, 'testimonies' => $testimonies, 'cat1' => $cat1, 'cat2' => $cat2, 'cat3' => $cat3, 'cat4' => $cat4, 'img_cat' => $img_cat]);
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
    public function getCategoriesView(Request $request, $parent)
    {
        if($request->ajax()) {
            $categories = Category::where('parent_id', $parent)->get();
            $categories->map( function($cat){
    
                $cat['num_products'] = $cat->getNumProducts();
                if(Category::where('parent_id', $cat->id)->count())
                    $cat['leaf'] = 0;
                else $cat['leaf'] = 1;
                
            });
            return response()->json([
                'categories' => $categories,
            ]);
        }
        else {

            if($parent == "all") {
                $categories = Category::whereIsLeaf()->get();
                $cat_par = null;
                $type = 1;
            }
            elseif($parent == 0) {
                $categories = Category::where('parent_id', 1)->get();
                $cat_par = Category::findOrFail($parent);
                $type = 2;
            } 
            else {
                $categories = Category::where('parent_id', $parent)->get();
                $cat_par = Category::findOrFail($parent);
                $type = 2;
            }
    
            /**
             * Se non esistono sottocategorie restituisce la vista dei prodotti
             * di quella categoria.
             */
            if(!$categories->count() && !($parent == 'all')) {
                return $this->getCatalogoCategory($parent);
            }
    
            
    
            $categories->map( function($cat){
    
                $cat['num_products'] = ProductType::whereHas('categories', function($query) use ($cat) {
                    $query->where('category_product_type.category_id', '=', $cat->id);
                })->pluck('id')->count();

                if(Category::where('parent_id', $cat->id)->count())
                    $cat['leaf'] = 0;
                else $cat['leaf'] = 1;
                
            });
    
            return view('frontoffice.pages.categories', ['categories' => $categories, 'parent' => $cat_par, 'type' => $type]);
        }
        
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

        return $this->showSearchResults($products, $request->search);

    }

    /**
     * Mostra i risultati della ricerca
     */
    public function showSearchResults($products, $query)
    {
        return view('frontoffice.pages.search', ['products' => $products, 'search' => $query]);
    }

    public function showCarrier($idCarrier) {

        $carrier = CarrierController::getById($idCarrier);

        return View('frontoffice.pages.carrier_detail', ['carrier' => $carrier]);
    }

    
}
