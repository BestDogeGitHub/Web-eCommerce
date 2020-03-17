<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\PaymentMethod;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $rules = array(
            'details' => 'required|max:1500',
            'payment' => 'required|numeric|between:0,99999.999',
            'order_id' => 'required|integer|min:0|exists:orders,id',
            'payment_method_id' => 'required|integer|min:0|exists:payment_methods,id'
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return View('backoffice.pages.edit_invoices', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('invoices.create');
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
        
        $invoice = new Invoice();
        $invoice->fill( $request->all() );
        $invoice->save();
    
        return response()->json(['success' => 'success!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);

        return View::make('invoices.show')->with('invoice', $invoice);
    }
    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $invoice = Invoice::find($id);
        $invoice->delete();
        
        return response()->json(['success' => 'success!']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function getPDF($id)
    {
        $invoice = Invoice::find($id);
        return View('backoffice.partials._partial_invoice_to_pdf', ['invoice' => $invoice]);
       
    }
}