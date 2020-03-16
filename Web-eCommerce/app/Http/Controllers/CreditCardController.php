<?php

namespace App\Http\Controllers;

use App\CreditCard;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit_cards = CreditCard::paginate(20);

        return View::make('credit_cards.index')->with('credit_cards', $credit_cards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('credit_cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate
        ([
            'type' => 'required|max:20',
            'number' => 'required|integer|max:20',
            'expiration_date' => 'required|regex:^([0-1][1-9])\/([0-9]{2})$|max:6',
            'user_id' => 'required|integer',
        ]);
        
        $credit_card = new CreditCard();
        $credit_card->fill( $request->all() );
        $credit_card->save();
    
        // redirect
        Session::flash('message', 'Successfully created credit_card!');
        return Redirect::to('credit_cards');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credit_card = CreditCard::find($id);

        return View::make('credit_cards.show')->with('credit_card', $credit_card);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit_card = CreditCard::find($id);

        return View::make('credit_cards.edit')->with('credit_card', $credit_card);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate
        ([
            'type' => 'required|max:20',
            'number' => 'required|integer|max:20',
            'expiration_date' => 'required|regex:^([0-1][1-9])\/([0-9]{2})$|max:6',
            'user_id' => 'required|integer',
        ]);
            // store
        $credit_card = CreditCard::find($id);
        $credit_card->fill( $request->all() );
        $credit_card->save();
        // redirect
        Session::flash('message', 'Successfully updated credit_card!');
        return Redirect::to('credit_cards');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $credit_card = CreditCard::find($id);
        $credit_card->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('credit_cards');
    }
}