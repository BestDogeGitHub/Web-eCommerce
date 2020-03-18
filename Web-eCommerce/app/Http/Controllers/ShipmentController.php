<?php

namespace App\Http\Controllers;

use App\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    protected $rules;

    public function __construct()
        {
            $this->rules = array(
                'tracking_number' => 'required|integer|max:999999999999999',
                'delivery_date' => 'required|date',
                'order_id' => 'required|integer|min:0|exists:orders,id',
                'address_id' => 'required|integer|min:0|exists:addresses,id',
                'carrier_id' => 'required|integer|min:0|exists:carriers,id',
                'delivery_status_id' => 'required|integer|min:0|exists:delivery_statuses,id'
            );
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::all();

        return View('backoffice.pages.edit_shipments', ['shipments' => $shipments]);
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
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        
        $shipment = new Shipment();
        $shipment->fill( $request->all() );
        $shipment->save();
    
        return response()->json(['success' => 'success!']);
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
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        // store
        $shipment = Shipment::find($id);
        $shipment->fill( $request->all() );
        $shipment->save();

        return response()->json(['success' => 'success!']);
        
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

        return response()->json(['success' => 'success!']);
    }
}