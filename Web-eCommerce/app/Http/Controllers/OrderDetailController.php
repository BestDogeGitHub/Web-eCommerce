<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_details = OrderDetail::paginate(20);

        return View::make('order_details.index')->with('order_details', $order_details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('order_details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_detail = new OrderDetail();
        $order_detail->fill( $request->all() );
        $order_detail->save();
    
        // redirect
        Session::flash('message', 'Successfully created order_detail!');
        return Redirect::to('order_details');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_detail = OrderDetail::find($id);

        return View::make('order_details.show')->with('order_detail', $order_detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        if(request()->ajax())
        {
            return response()->json([
                'orderDetail' => $orderDetail, 
                'product' => $orderDetail->product,
                'product_type' => $orderDetail->product->productType
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        // store
        $order_detail = OrderDetail::find($id);
        $order_detail->fill( $request->all() );
        $order_detail->save();
        // redirect
        Session::flash('message', 'Successfully updated order_detail!');
        return Redirect::to('order_details');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $order_detail = OrderDetail::find($id);
        $order_detail->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('order_details');
    }
}