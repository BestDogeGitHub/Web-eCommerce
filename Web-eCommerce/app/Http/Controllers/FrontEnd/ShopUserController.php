<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Product;

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
        $delivery = 20;

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

}
