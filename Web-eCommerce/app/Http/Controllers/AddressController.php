<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::paginate(20);

        return View::make('addresses.index')->with('addresses', $addresses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('addresses.create');
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
            'building_number' => 'required|integer|max:1500',
            'street_number' => 'required|integer|max:1500',
            'postcode' => 'required|integer',
            'country_code' => 'required|size:2|alpha',
            'town_id' => 'required|integer',
        ]);
        
        $address = new Address();
        $address->fill( $request->all() );
        $address->save();
    
        // redirect
        Session::flash('message', 'Successfully created address!');
        return Redirect::to('addresses');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);

        return View::make('addresses.show')->with('address', $address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::find($id);

        return View::make('addresses.edit')->with('address', $address);
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
            'building_number' => 'required|integer|max:1500',
            'street_number' => 'required|integer|max:1500',
            'postcode' => 'required|integer',
            'country_code' => 'required|size:2|alpha',
            'town_id' => 'required|integer',
        ]);
            // store
        $address = Address::find($id);
        $address->fill( $request->all() );
        $address->save();
        // redirect
        Session::flash('message', 'Successfully updated address!');
        return Redirect::to('addresses');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $address = Address::find($id);
        $address->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('addresses');
    }
}