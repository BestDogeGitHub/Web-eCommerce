<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $rules;

    public function __construct()
    {
        $this->rules = array(
            'PO_Number' => 'required|integer|min:1|max:999999999999999',
            'user_id' => 'required|integer|min:0|exists:users,id'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return View('backoffice.pages.edit_orders', ['orders' => $orders]);
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
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        $order = new Order();
        $order->fill( $request->all() );
        $order->save();
    
        return response()->json(['success' => 'success!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $ord = Order::where('id', '=', $order->id)->get();

        return View('backoffice.pages.edit_orders', ['orders' => $ord]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if(request()->ajax())
        {
            return response()->json([
                'order' => $order, 
                'orderDetails' => $order->orderDetails,
                'shipment' => $order->shipment,
                'invoice' => $order->invoice,
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
        
        $order = Order::find($id);
        $order->fill( $request->all() );
        $order->save();

        return response()->json(['success' => 'success!']);
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

        return response()->json(['success' => 'success!']);
    }

    public function makeOrder( Request $request ) // la richiesta deve contenere il metodo di pagamento e l'utente
    {
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $products = $user->productsInCart();

        return $products;
    }
}