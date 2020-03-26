<?php

namespace App\Http\Controllers;

use App\Shipment;
use App\DeliveryStatus;
use App\Carrier;
use Illuminate\Http\Request;
use Validator;

class ShipmentController extends Controller
{

    protected $rules;
    protected $_uprules;

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

            // Per l'update servono regole diverse, non sono obbligatori tutti i campi
            $this->_uprules = array_merge( array(), $this->rules);
            unset($this->_uprules['tracking_number']);
            unset($this->_uprules['order_id']);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$shipments = Shipment::whereNotIn("delivery_status_id", [1, 7])->get();
        $shipments = Shipment::orderBy('id', 'DESC')->take(20)->get();
        $statuses = DeliveryStatus::all();
        $carriers = Carrier::all();

        return View('backoffice.pages.edit_shipments', ['shipments' => $shipments, 'statuses' => $statuses, 'carriers' => $carriers]);
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
    public function update( Request $request, Shipment $shipment )
    {

        $error = Validator::make($request->all(), $this->_uprules);
        if($error->fails()){ 
            return response()->json(['errors' => $error->errors()->all()]); 
        }

        $data = array(
            'tracking_number' => $request->tracking_number,
            'delivery_date' => $request->delivery_date,
            'address_id' => $request->address_id,
            'carrier_id' => $request->carrier_id,
            'delivery_status_id' => $request->delivery_status_id
        ); 

        $shipment->update($data);

        return response()->json(['success' => 'Shipment updated successfully!']);
        
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

    public static function getDeliveryCost() {
        return 20;
    }
}