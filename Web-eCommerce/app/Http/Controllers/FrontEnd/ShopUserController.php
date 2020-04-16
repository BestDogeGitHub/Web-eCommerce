<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Product;
use App\Nation;
use App\Town;
use App\PaymentMethod;
use App\CreditCardCompany;
use App\CreditCard;
use App\Address;
use App\Coupon;
use App\Order;

use Validator;
use Session;
use Cookie;

class ShopUserController extends Controller
{
    
    /**
     * Restituisce al wishlist dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getWishlist() {

        $wishlist = collect();

        if(!Auth::check()) {
            
            /**
             * SESSION USER
             */
            //Session::forget('wishlist');

            //dd(Session::all());

            if(Cookie::get('laravel_cookie_consent') !== null) {
            

                if(Session::has('wishlist')) {
                    $checkArray = array();
                    foreach(Session::get('wishlist') as $id) {
                        if(is_numeric($id)) array_push($checkArray, $id);
                    }

                    $wishlist = Product::whereIn('id', $checkArray)->get();
                    
                }
            }

        } 
        else {
            /**
             * AUTHENTICATED USER
             */
            $user = Auth::user();
            $wishlist = $user->productInWishlist;

        }

        // MANIPULATE PRODUCT FOR VISUALIZATION
        $wishlist->map(function ($product) {
            $product->payment = number_format((float)$product->payment, 2, '.', '');

            if(count($product->productImages)) {
                $product['image'] = $product->productImages->first()->image_ref;
            }
            elseif ($product->productType->image_ref){
                $product['image'] = $product->productType->image_ref;
            }
            else $product['image'] = "/images/products/no-image.png";
    
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

        if(!Auth::check()) {
            
            /**
             * SESSION USER
             */

            if(Cookie::get('laravel_cookie_consent') !== null) {

                if($request->session()->has('wishlist')) {
                    $wishlist = $request->session()->get('wishlist');
                } else {
                    $wishlist = [];
                }


                if(in_array($product->id, $wishlist)) {
                    return response()->json('error', 409); // Conflict
                }

                array_push($wishlist, $product->id);

                $request->session()->put('wishlist', $wishlist);
            } else {
                return response()->json('Cookies not accepted', 400); // Bad Request
            }


        } else {
            /**
             * AUTHENTICATED USER
             */

            $user = Auth::user();
            if($user->productInWishlist->find($request->id)) {
                return response()->json('error', 409); // Conflict
            }
    
            $user->productInWishlist()->syncWithoutDetaching($product);

        }

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
        if(!Auth::check()) {
            
            /**
             * SESSION USER
             */

            if(Cookie::get('laravel_cookie_consent') !== null) {

                if(Session::has('wishlist')) {
                    $wishlist = Session::get('wishlist');

                    if (($key = array_search($id, $wishlist)) !== false) {
                        unset($wishlist[$key]);
                        Session::put('wishlist', $wishlist);
                    } else {
                        return response()->json('error', 404); // Not Found
                    }
                }
            } else {
                return response()->json('Cookies not accepted', 400); // Bad Request
            }


        } else {
            /**
             * AUTHENTICATED USER
             */
            $product = Product::findOrFail($id);
        
            $user = Auth::user();
            
            $user->productInWishlist()->detach($product);
        }
        
    
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

        $subtotal = 0;
        $discount = 0;
        // DELIVERY COST
        $delivery = ShipmentController::getDeliveryCost();

        if(!Auth::check()) {
            
            /**
             * SESSION USER
             */
            $cart = collect();

            if(Cookie::get('laravel_cookie_consent') !== null) {

                if(Session::has('cart')) {

                    $cart_var = Session::get('cart');

                    $cart = Product::whereIn('id', array_keys($cart_var))->get(); // Le chiavi sono gli id dei prodotti

                    $cart->map(function ($product) use ($cart_var) {
                        $product['quantity'] = $cart_var[$product->id];
                
                        return $product;
                    });
                    
                }
            } 


        } else {

            $user = Auth::user();
            $cart = $user->productsInCart;

            $cart->map(function ($product) {
                $product['quantity'] = $product->pivot->quantity;
        
                return $product;
            });
            
        }

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
        });

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

        if(!Auth::check()) {
            
            /**
             * SESSION USER
             */

            if(Cookie::get('laravel_cookie_consent') !== null) {

                if($request->session()->has('cart')) {
                    $cart = $request->session()->get('cart');
                } else {
                    $cart = [];
                }

                if(array_key_exists($product->id, $cart)) {
                    return response()->json('error', 409); // Conflict
                }

                $cart[$product->id] = 1;
                
                $request->session()->put('cart', $cart);

            } else {
                return response()->json('Cookies not accepted', 400); // Bad Request
            }


        } else {
            /**
             * AUTHENTICATED USER
             */

            $user = Auth::user();

            if($user->productsInCart->contains($request->id)){
                return response()->json('error', 409);
            }
            
            $user->productsInCart()->syncWithoutDetaching($product);
        }
    
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
        if(!Auth::check()) {
            
            /**
             * SESSION USER
             */

            if(Cookie::get('laravel_cookie_consent') !== null) {

                if(Session::has('cart')) {
                    $cart = Session::get('cart');

                    if(array_key_exists($id, $cart)) {
                        unset($cart[$id]);
                        Session::put('cart', $cart);
                    } else {
                        return response()->json('error', 404); // Not Found
                    }
                }
            } else {
                return response()->json('Cookies not accepted', 400); // Bad Request
            }


        } else {
            /**
             * AUTHENTICATED USER
             */
            $product = Product::findOrFail($id);
            
            $user = Auth::user();
            
            $user->productsInCart()->detach($product);
        }
    
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

        $rules = array(
            'quantity' => 'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        
        if(!Auth::check()) { 
            /**
             * Guest session user
             */
            if(Cookie::get('laravel_cookie_consent') !== null) {

                if($request->session()->has('cart')) { 
                    $cart_var = $request->session()->get('cart');

                    if(array_key_exists($id, $cart_var)) {
                        $cart_var[$id] = $request->quantity;
                    }
                    else {
                        return response()->json('error', 404);
                    }

                    $request->session()->put('cart', $cart_var);
                }
            
            } else {
                return response()->json('Cookies not accepted', 400); // Bad Request
            }



        }
        else {
            /**
             * Authenticated
             */
            $user = Auth::user();

            if(!$user->productsInCart->contains($id)){
                return response()->json('error', 404);
            }

            $user->productsInCart->find($id)->pivot->quantity = $request->quantity;
            $user->productsInCart->find($id)->pivot->save();

        }
        

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
        $nations = Nation::orderBy('name')->get();
        $town = Town::orderBy('name')->get();
        $companies = CreditCardCompany::all();

        $user = Auth::user();
        $cart = $user->productsInCart;
        $subtotal = 0;
        $discount = 0;

        foreach($cart as $product)
        {
            if($product->sale != 0){
                $realprice = $product->payment - ($product->payment / 100 * $product->sale);
                $discount += $product->payment - $realprice;
                $subtotal += $realprice;
            }
            else {
                $subtotal += $product->payment;
            } 
            
        } 

        // Manipulate product
        $cart->map(function ($product) {
            $product->payment = number_format((float)$product->payment, 2, '.', '');
    
            return $product;
        });
        
        

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
    public function checkCoupon(Request $request)
    {
        if(request()->ajax())
        {
            $error = Validator::make($request->all(), [
                'code' => 'required|string|max:50'
            ]);

            if($error->fails()){
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $coupon = Coupon::where('code', '=', $request->code)->first();
            if($coupon) return response()->json(['coupon' => $coupon]);
            else return response()->json(['errors' => ['Incorrect coupon code. No coupons found']]);
        }
    }

    /**
     * Make Order
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeOrder(Request $request)
    {

        // VALIDATION OF INPUT FIELDS

        $rules = array(

            /**
             * Validation Rules for User Data
             */
            'email' => 'required|string|exists:users,email',

            /**
             * Validation Rules for Address
             */
            'building_number' => 'required|numeric|digits_between:1,11',
            'street_number' => 'required|numeric|digits_between:1,11',
            'postcode' => 'required|string|min:1|max:10',
            'town_id' => 'required|numeric|exists:towns,id',
            'country_code' => 'required|string|size:2',

            /**
             * Validation Rules for Coupon
             */
            'coupon' => 'nullable|string|max:50',

            /**
             * Validation Rules for Credit Card
             */
            'associated' => 'required|boolean',
            'card_id' => 'required_if:associated,1|numeric|exists:credit_cards,id',
            'short_comp' => 'required_if:associated,0|max:5|min:1|exists:credit_card_companies,id',
            'company' => 'required_if:short_comp,5|exists:credit_card_companies,id',
            'number' => 'required_if:associated,0|digits_between:10,20',
            'exp_month' => 'required_if:associated,0|integer|between:1,12',
            'exp_year' => 'required_if:associated,0|integer|between:0,99',

            /**
             * Validation Rules for Conditions
             */
            'conditions' => 'required|accepted'

        );

        $error = Validator::make($request->all(), $rules)->validate();

        /**
         * Dynamic Validation
         */

        // Check if associated is true and card_id not exists
        if($request->associated && !isset($request->card_id)){ return redirect()->route('checkout')->withErrors(['customError' => 'Card is not defined']); }
        
        // Check if cart is empty
        if(!count(Auth::user()->productsInCart)){ return redirect()->route('checkout')->withErrors(['customError' => 'Cart is empty!!!']); }

        // CHECK COUPON
        if(!empty($request->coupon) && !count(Coupon::where('code', '=', $request->coupon)->get())) { return redirect()->route('checkout')->withErrors(['customError' => 'Coupon is not valid']); }

        

        // CREATE ADDRESS IF NOT EXISTS
        $address_id = AddressController::addressChecker($request->building_number, $request->street_number, $request->postcode, $request->town_id, $request->country_code);
        

        $paymentMethod = 1;
        
        // CHECK CREDIT CARD
        if($request->associated) {
            // Check if card id is associated with auth userr
            if(!Auth::user()->creditCards->find($request->card_id)) { return redirect()->route('checkout')->withErrors(['customError' => 'Card is not associated to authenticated user!!!']); }
            
            $card_id = $request->card_id;
        }
        else {

            if($request->short_comp == 1) {
                /**
                 * Visa CASE
                 */
                $card_company = CreditCardCompany::where('name', 'Visa')->pluck('id')->first();
            }
            elseif($request->short_comp == 2) {
                /**
                 * Mastercard CASE
                 */
                $card_company = CreditCardCompany::where('name', 'Mastercard')->pluck('id')->first();
            }
            elseif($request->short_comp == 3) {
                /**
                 * American Express CASE
                 */
                $card_company = CreditCardCompany::where('name', 'American Express')->pluck('id')->first();
            }
            elseif($request->short_comp == 4) {
                /**
                 * PAYPAL CASE
                 */
                $card->company = null;
                $paymentMethod = 2;
            } 
            else {
                /**
                 * Other companies CASE
                 */
                $card_company = $request->company;
            }
            $data = array(
                'number' => $request->number,
                'expiration_date' => $request->exp_month . '/' . $request->exp_year,
                'user_id' => Auth::user()->id,
                'credit_card_company_id' => $card_company
            );

            $card_id = CreditCard::create($data)->id;
        
        }


        $coupon_id = Coupon::where('code', $request->coupon)->pluck('id')->first();
        

        /**
         * Create Order
         */

        OrderController::checkout(Auth::user()->id, $card_id, $address_id, $coupon_id, $paymentMethod);

        return redirect()->route('orders');

    }


    /**
     * Show Orders
     * 
     * @return \Illuminate\Http\Response
     */
    public function showOrders()
    {
        $user = Auth::user();
        $orders = $user->orders;

        return view('frontoffice.pages.orders', ['orders' => $orders]);
    }

    /**
     * Show invoice
     */
    public function showInvoice($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);
        if($order->user->id == $user->id || $user->hasAnyRole(['Administrator']))
        {
            return view('shared._partial_invoice_to_pdf', ['invoice' => $order->invoice]);
        }
        else{
            abort(401); // HTTP ERROR 401 UNAUTHORIZED - Utente non autorizzato alla visualizzazione della fattura, non è sua
        }
    }


}
