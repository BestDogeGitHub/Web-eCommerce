<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;
use Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentMethod::all();

        return View('backoffice.pages.edit_payment_methods', ['paymentMethods' => $payments]);
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
        $rules = array(
            'method' => 'required|string|min:1'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'method' => $request->method
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        PaymentMethod::create($data);
        

        return response()->json(['success' => 'Payment Method Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $payment_method)
    {

        return View::make('payment_methods.show')->with('payment_method', $paymentMethod);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $paymentMethod
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, PaymentMethod $paymentMethod )
    {
        $rules = array(
            'method' => 'required|string|min:1'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'method' => $request->method
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $paymentMethod->update($data);
        

        return response()->json(['success' => 'Payment Method Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
    }
}