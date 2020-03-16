<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethod::paginate(20);

        return View::make('payment_methods.index')->with('payment_methods', $payment_methods);
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
        // validate
        $request->validate
        ([
            'method' => 'required|max:30|unique:payment_methods,method'
        ]);
        
        $payment_method = new PaymentMethod();
        $payment_method->fill( $request->all() );
        $payment_method->save();
    
        // redirect
        Session::flash('message', 'Successfully created payment_method!');
        return Redirect::to('payment_methods');
        
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate
        ([
            'method' => 'required|max:30|unique:payment_methods,method'
        ]);
            // store
        $payment_method = PaymentMethod::find($id);
        $payment_method->fill( $request->all() );
        $payment_method->save();
        // redirect
        Session::flash('message', 'Successfully updated payment_method!');
        return Redirect::to('payment_methods');
        
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
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('payment_methods');
    }
}