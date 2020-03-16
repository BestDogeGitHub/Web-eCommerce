<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(20);

        return View::make('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $order = new Order();
        $order->fill( $request->all() );
        $order->save();
    
        // redirect
        Session::flash('message', 'Successfully created order!');
        return Redirect::to('orders');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return View::make('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return View::make('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        // store
        $order = Order::find($id);
        $order->fill( $request->all() );
        $order->save();
        // redirect
        Session::flash('message', 'Successfully updated order!');
        return Redirect::to('orders');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $order = Order::find($id);
        $order->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('orders');
    }
}