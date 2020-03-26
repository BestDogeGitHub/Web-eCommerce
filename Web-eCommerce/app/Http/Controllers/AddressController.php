<?php

namespace App\Http\Controllers;

use App\Address;
use App\Town;
use App\Nation;
use Illuminate\Http\Request;
use Validator;

class AddressController extends Controller
{

    protected $rules;

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
        
        $this->rules = array(
            'building_number' => 'required|numeric|min:0|max:1500',
            'street_number' => 'required|numeric|min:0|max:1500',
            'postcode' => 'required|string',
            'country_code' => 'required|string|min:2|max:2',
            'town_id' => 'required|numeric'
        );

        $error = Validator::make($request->all(), $this->rules);

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
    public function edit(Address $address)
    {
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
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Address $address )
    {
        $this->rules = array(
            'building_number' => 'required|numeric|min:0||max:1500',
            'street_number' => 'required|numeric|min:0||max:1500',
            'postcode' => 'required|string',
            'country_code' => 'required|string|min:2|max:2',
            'town_id' => 'required|numeric'
        );

        $error = Validator::make($request->all(), $this->rules);

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
        
        return response()->json(['success' => 'address updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
    }

    /**
     * Check if the address exists or not, and create it if not exitsts
     * 
     * @param $building_number
     * @param $street_number
     * @param $postcode
     * @param $town_id
     *  
     * @return $address_id (INTEGER)
     */
    public static function addressChecker($building_number, $street_number, $postcode, $town_id, $country_code)
    {
        $id = Address::where([
            ['building_number', '=', $building_number],
            ['street_number', '=', $street_number],
            ['postcode', '=', $postcode],
            ['town_id', '=', $town_id],
            ['country_code', '=', $country_code]
            ])->pluck('id')->first();

        if(!$id) {

            $data = array(
                'building_number' => $building_number,
                'postcode' => $postcode,
                'street_number' => $street_number,
                'country_code' => $country_code,
                'town_id' => $town_id
            );

            $id = Address::create($data)->id;
        }

        return $id;
    }
}