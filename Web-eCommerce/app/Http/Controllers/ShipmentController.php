<?php

namespace App\Http\Controllers;

use App\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::paginate(20);

        return View::make('shipments.index')->with('shipments', $shipments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('shipments.create');
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
            'tracking_number' => 'required|integer|max:999999999999999',
            'delivery_date' => 'required|date',
        ]);
        
        $shipment = new Shipment();
        $shipment->fill( $request->all() );
        $shipment->save();
    
        // redirect
        Session::flash('message', 'Successfully created shipment!');
        return Redirect::to('shipments');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipment = Shipment::find($id);

        return View::make('shipments.show')->with('shipment', $shipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        return response()->json([
            'shipment' => $shipment, 
            'carrier' => $shipment->carrier,
            'order' => $shipment->order,
            'delivery_status' => $shipment->deliveryStatus
        ]);
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
            'tracking_number' => 'required|integer|max:999999999999999',
            'delivery_date' => 'required|date',
        ]);
            // store
        $shipment = Shipment::find($id);
        $shipment->fill( $request->all() );
        $shipment->save();
        // redirect
        Session::flash('message', 'Successfully updated shipment!');
        return Redirect::to('shipments');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $shipment = Shipment::find($id);
        $shipment->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('shipments');
    }
}