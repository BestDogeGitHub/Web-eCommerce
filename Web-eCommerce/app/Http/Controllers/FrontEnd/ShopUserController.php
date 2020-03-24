<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ShipmentController;
use App\Product;
use App\Nation;
use App\Town;
use App\PaymentMethod;
use App\CreditCardCompany;
use Validator;

class ShopUserController extends Controller
{
    
    /**
     * Restituisce al wishlist dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getWishlist() {
        $user = Auth::user();
        $wishlist = $user->productInWishlist;
        // Manipulate product
        $wishlist->map(function ($product) {
            $product->payment = number_format((float)$product->payment, 2, '.', '');
    
            return $product;
        });;

        return view('frontoffice.pages.wishlist', ['wishlist' => $wishlist]);
    }

    /**
     * Store the product in wishlist
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToWishlist(Request $request)
    {   
        $product = Product::findOrFail($request->id);

        $user = Auth::user();

        if($user->productInWishlist->find($request->id)){
            return response()->json('error', 409);
        }

        $user->productInWishlist()->syncWithoutDetaching($product);
        
    
        return response()->json(['success' => 'Product successfully added to wishlist!']);
    }

    /**
     * Delete product from cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromWishlist($id)
    {   
        $product = Product::findOrFail($id);
        
        $user = Auth::user();
        
        $user->productInWishlist()->detach($product);
    
        return response()->json(['success' => 'Product successfully deleted from wishlist!']);
    }



    /**
     * CART METHODS
     */

    /**
     * Restituisce al wishlist dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCart() {
        $user = Auth::user();
        $cart = $user->productsInCart;
        $subtotal = 0;
        $discount = 0;
        foreach($cart as $product)
        {
            if($product->sale != 0){
                $fullprice = $product->payment / (1 - $product->sale / 100);
                $discount += $fullprice - $product->payment;
                $subtotal += $fullprice;
            }
            else {
                $subtotal += $product->payment;
            } 
            
        } 
        // Manipulate product
        $cart->map(function ($product) {
            $product->payment = number_format((float)$product->payment, 2, '.', '');
    
            return $product;
        });;
        
        

        // DELIVERY COST
        $delivery = ShipmentController::getDeliveryCost();

        return view('frontoffice.pages.cart', ['cart' => $cart, 'subtotal' => number_format((float)$subtotal, 2, '.', ''), 'delivery' => number_format((float)$delivery, 2, '.', ''), 'discount' => number_format((float)$discount, 2, '.', '')]);
    }

    /**
     * Store the product in cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {   
        $product = Product::findOrFail($request->id);

        $user = Auth::user();

        if($user->productsInCart->contains($request->id)){
            return response()->json('error', 409);
        }
        
        $user->productsInCart()->syncWithoutDetaching($product);
    
        return response()->json(['success' => 'Product successfully added to cart!']);
    }

    /**
     * Delete product from cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart($id)
    {   
        $product = Product::findOrFail($id);
        
        $user = Auth::user();
        
        $user->productsInCart()->detach($product);
    
        return response()->json(['success' => 'Product successfully deleted from cart!']);
    }

    /**
     * Edit quantity of product from cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function setQuantityCart($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $user = Auth::user();

        if(!$user->productsInCart->contains($id)){
            return response()->json('error', 404);
        }

        $rules = array(
            'quantity' => 'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        
        $user->productsInCart->find($id)->pivot->quantity = $request->quantity;
        $user->productsInCart->find($id)->pivot->save();

        return response()->json(['success' => 'Quantity successfully modified']);
    }


    /**
     * CHECKOUT
     */
    
     /**
     * Restituisce al wishlist dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCheckout() {

        /**
         * Billing data
         */
        $nations = Nation::all();
        $town = Town::all();
        $companies = CreditCardCompany::all();

        $user = Auth::user();
        $cart = $user->productsInCart;
        $subtotal = 0;
        $discount = 0;
        foreach($cart as $product)
        {
            if($product->sale != 0){
                $fullprice = $product->payment / (1 - $product->sale / 100);
                $discount += $fullprice - $product->payment;
                $subtotal += $fullprice;
            }
            else {
                $subtotal += $product->payment;
            } 
            
        } 
        // Manipulate product
        $cart->map(function ($product) {
            $product->payment = number_format((float)$product->payment, 2, '.', '');
    
            return $product;
        });;
        
        

        // DELIVERY COST
        $delivery = ShipmentController::getDeliveryCost();

        return view('frontoffice.pages.checkout', ['companies' => $companies, 'cart' => $cart, 'nations' => $nations, 'towns' => $town, 'subtotal' => number_format((float)$subtotal, 2, '.', ''), 'delivery' => number_format((float)$delivery, 2, '.', ''), 'discount' => number_format((float)$discount, 2, '.', '')]);
    }

    /**
     * Make Order
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function make_order(Request $request)
    {

        // VALIDATION OF INPUT FIELDS

        $rules = array(
            'building_number' => 'required|numeric|digits_between:1,11',
            'street_number' => 'required|numeric|digits_between:1,11',
            'postcode' => 'require|string|min:1|max:10',
            'town_id' => 'required|numeric|exists:towns:id',
            'method' => 'required|numeric|min:1|max:2'
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        /** TO IMPLEMENT */

    }

}
