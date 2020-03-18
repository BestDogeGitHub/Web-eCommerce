<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{

    protected $rules;

    public function __construct()
    {
        $this->rules = array(
            'quantity' => 'required|integer|min:1|max:1000000',
            'order_id' => 'required|integer|min:0|exists:orders,id',
            'product_id' => 'required|integer|min:0|exists:products,id'
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_details = OrderDetail::all();

        return View('backoffice.pages.edit_order_details', ['order_details' => $order_details]);
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
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        $order_detail = new OrderDetail();
        $order_detail->fill( $request->all() );
        $order_detail->save();
    
        return response()->json(['success' => 'success!']);
        
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
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        // store
        $order_detail = OrderDetail::find($id);
        $order_detail->fill( $request->all() );
        $order_detail->save();

        return response()->json(['success' => 'success!']);
        
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

        return response()->json(['success' => 'success!']);
    }
}