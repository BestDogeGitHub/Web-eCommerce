<?php

namespace App\Http\Controllers;

use App\DeliveryStatus;
use Illuminate\Http\Request;

class DeliveryStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_statuses = DeliveryStatus::paginate(20);

        return View::make('delivery_statuses.index')->with('delivery_statuses', $delivery_statuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('delivery_statuses.create');
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
            'status' => 'required|max:30|unique:delivery_statuses,status'
        ]);
        
        $delivery_statuse = new DeliveryStatus();
        $delivery_statuse->fill( $request->all() );
        $delivery_statuse->save();
    
        // redirect
        Session::flash('message', 'Successfully created delivery_statuse!');
        return Redirect::to('delivery_statuses');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery_statuse = DeliveryStatus::find($id);

        return View::make('delivery_statuses.show')->with('delivery_statuse', $delivery_statuse);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery_statuse = DeliveryStatus::find($id);

        return View::make('delivery_statuses.edit')->with('delivery_statuse', $delivery_statuse);
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
        $delivery_statuse = DeliveryStatus::find($id);
        $delivery_statuse->fill( $request->all() );
        $delivery_statuse->save();
        // redirect
        Session::flash('message', 'Successfully updated delivery_statuse!');
        return Redirect::to('delivery_statuses');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $delivery_statuse = DeliveryStatus::find($id);
        $delivery_statuse->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('delivery_statuses');
    }
}