<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Nation;
use App\Town;
use App\Review;
use App\Product;
use App\User;

use Validator;

class AuthUserController extends Controller
{
    /**
     * Restituisce il profilo dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProfile($changed = false) {
        $user = Auth::user();
        $nations = Nation::all();
        $towns = Town::all();

        return view('frontoffice.pages.profile', ['user' => $user, 'public' => false, 'nations' => $nations, 'towns' => $towns, 'changed' => $changed]);
    }

    /**
     * Restituisce il profilo pubblico
     */
    public function publicProfile($user_id)
    {   
        if($user_id == Auth::user()->id) return $this->getProfile();

        return view('frontoffice.pages.profile', ['user' => User::findOrFail($user_id), 'public' => true]);

    }

    /**
     * Aggiunge una recensione
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addReview($product, Request $request) {
        
        $rules = array(
            'text' => 'required|string|max:1000',
            'stars' => 'numeric|min:1|max:5'
        );

        $error = Validator::make($request->all(), $rules)->validate();
        
        $prod = Product::findOrFail($product);

        $me = Auth::user();

        $data = array(
            'text' => $request->text,
            'stars' => $request->stars,
            'product_id' => $prod->id,
            'user_id' => $me->id,
        );

        Review::create($data);

        return back();
    }

    /**
     * Restituisce il profilo dell'utente
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editProfile(Request $request)
    {
        $me = Auth::user();

        // VALIDATION OF INPUT FIELDS

        $rules = array(

            /**
             * Validation Rules for User Data
             */
            'name' => 'required|string|max:45',
            'surname' => 'required|string|max:45',
            'phone' => 'required|string|between:9,15',

            /**
             * Validation Rules for Address
             */
            'add_address' => 'boolean',
            'building_number' => 'required_if:add_address,1|numeric|min:1|digits_between:1,11',
            'street_number' => 'required_if:add_address,1|numeric|min:1|digits_between:1,11',
            'postcode' => 'required_if:add_address,1|string|min:1|max:10',
            'town_id' => 'required_if:add_address,1|numeric|exists:towns,id',
            'country_code' => 'required_if:add_address,1|string|size:2',



        );

        $error = Validator::make($request->all(), $rules)->validate();

        $data = array(
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
        );

        $me->update($data);

        return $this->getProfile(true);
    }
}
