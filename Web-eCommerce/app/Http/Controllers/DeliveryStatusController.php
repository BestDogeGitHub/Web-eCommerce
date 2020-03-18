<?php

namespace App\Http\Controllers;

use App\DeliveryStatus;
use Illuminate\Http\Request;
use Validator;

class DeliveryStatusController extends Controller
{

    protected $rules;

    public function __construct()
    {
        $rules = array(
            'status' => 'required|max:30|unique:delivery_statuses,status'
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryStatuses = DeliveryStatus::all();

        return View('backoffice.pages.edit_delivery_statuses', ['deliveryStatuses' => $deliveryStatuses]);
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
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $delivery_status = new DeliveryStatus();
        $delivery_status->fill( $request->all() );
        $delivery_status->save();

        return response()->json(['success' => 'delivery_status added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery_status = DeliveryStatus::find($id);

        return View::make('delivery_statuses.show')->with('delivery_statuse', $delivery_status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryStatus $deliveryStatus)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $deliveryStatus
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, DeliveryStatus $deliveryStatus )
    {
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $delivery_status = DeliveryStatus::find($id);
        $delivery_status->fill( $request->all() );
        $delivery_status->save();
        
        return response()->json(['success' => 'delivery_status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryStatus $deliveryStatus)
    {
        $deliveryStatus->delete();
    }
}