<?php

namespace App\Http\Controllers;

use App\Address;
use App\Town;
use App\Nation;
use Illuminate\Http\Request;
use Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
        $towns = Town::all();

        return View('backoffice.pages.edit_addresses', ['addresses' => $addresses, 'towns' => $towns]);
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
<<<<<<< HEAD
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
        
=======
        
        $rules = array(
            'building_number' => 'required|numeric|min:0',
            'street_number' => 'required|numeric|min:0',
            'postcode' => 'required|string',
            'country_code' => 'required|string|min:2|max:2',
            'town_id' => 'required|numeric'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // CHECK TOWN
        $producer = Town::findOrFail($request->town_id);

        $data = array(
            'building_number' => $request->building_number,
            'street_number' => $request->street_number,
            'postcode' => $request->postcode,
            'country_code' => $request->country_code,
            'town_id' => $request->town_id
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        Address::create($data);
        

        return response()->json(['success' => 'Address Added successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
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
<<<<<<< HEAD
        $address = Address::find($id);

        return View::make('addresses.edit')->with('address', $address);
=======
        if(request()->ajax())
        {
            $town = Town::where('id', $address->town_id)->first();
            $nation = Nation::where('id', $town->nation_id)->first();
            return response()->json([
                'data' => $address, 
                'town_info' => $town,
                'nation_info' => $nation
            ]);
        }
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
<<<<<<< HEAD
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
        
=======
        $rules = array(
            'building_number' => 'required|numeric|min:0',
            'street_number' => 'required|numeric|min:0',
            'postcode' => 'required|string',
            'country_code' => 'required|string|min:2|max:2',
            'town_id' => 'required|numeric'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // CHECK TOWN
        $producer = Town::findOrFail($request->town_id);

        $data = array(
            'building_number' => $request->building_number,
            'street_number' => $request->street_number,
            'postcode' => $request->postcode,
            'country_code' => $request->country_code,
            'town_id' => $request->town_id
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $address->update($data);
        
        return response()->json(['success' => 'Procut Updated successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        // delete
        $address = Address::find($id);
        $address->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('addresses');
=======
        $address->delete();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}