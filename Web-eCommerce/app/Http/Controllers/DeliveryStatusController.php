<?php

namespace App\Http\Controllers;

use App\DeliveryStatus;
use Illuminate\Http\Request;
use Validator;

class DeliveryStatusController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'status' => 'required|string|min:1'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'status' => $request->status
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        DeliveryStatus::create($data);
        

        return response()->json(['success' => 'Status Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryStatus $deliveryStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryStatus  $deliveryStatus
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryStatus $deliveryStatus)
    {
        $rules = array(
            'status' => 'required|string|min:1'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'status' => $request->status
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $deliveryStatus->update($data);
        

        return response()->json(['success' => 'Status Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryStatus $deliveryStatus)
    {
        $deliveryStatus->delete();
    }
}
