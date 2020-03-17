<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct()
        {
            $rules = array(
                'method' => 'required|max:30|unique:payment_methods,method'
            );
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();

        return View('backoffice.pages.edit_payment_methods', ['payment_methods' => $payment_methods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('payment_methods.create');
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
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        $payment_method = new PaymentMethod();
        $payment_method->fill( $request->all() );
        $payment_method->save();
    
        return response()->json(['success' => 'success!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_method = PaymentMethod::find($id);

        return View::make('payment_methods.show')->with('payment_method', $payment_method);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_method = PaymentMethod::find($id);

        return View::make('payment_methods.edit')->with('payment_method', $payment_method);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        $payment_method = PaymentMethod::find($id);
        $payment_method->fill( $request->all() );
        $payment_method->save();

        return response()->json(['success' => 'success!']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $payment_method = PaymentMethod::find($id);
        $payment_method->delete();

        return response()->json(['success' => 'success!']);
    }
}