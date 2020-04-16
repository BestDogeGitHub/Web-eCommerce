<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use App\User;
use App\Product;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Session;
use Cookie;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/[0-9]*/', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'username' => $data['username'],
            'surname' => $data['surname'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone']
        ]);

        $user->assignRole('User');

        if(Cookie::get('laravel_cookie_consent') !== null) {
        
            if(Session::has('wishlist')) {
                $checkArray = array();
                foreach(Session::get('wishlist') as $id) {
                    if(is_numeric($id)) array_push($checkArray, $id);
                }

                $wishlist = Product::whereIn('id', $checkArray)->get();
                $user->productInWishlist()->attach($wishlist);

                Session::forget('wishlist');
            }
            
            if(Session::has('cart')) {
                $cart_var = Session::get('cart');

                $cart = Product::whereIn('id', array_keys($cart_var))->get(); // Le chiavi sono gli id dei prodotti

                foreach($cart as $product) {

                    $user->productsInCart()->attach($product->id, array('quantity' => $cart_var[$product->id]));

                }
                Session::forget('cart');
            }
        
        }

        return $user;
    }
}
