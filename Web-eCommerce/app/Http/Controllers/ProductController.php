<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(20);

        return View::make('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('products.create');
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
            'payment' => 'required|numeric',
            'sale' => 'required|integer|max:100',
            'stock' => 'required|integer|max:10000000',
            'available' => 'required|boolean',
            'info' => 'required|max:1500',
        ]);
        
        $product = new Product();
        $product->fill( $request->all() );
        $product->save();
    
        // redirect
        Session::flash('message', 'Successfully created product!');
        return Redirect::to('products');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return View::make('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return View::make('products.edit')->with('product', $product);
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
            'payment' => 'required|numeric',
            'sale' => 'required|integer|max:100',
            'stock' => 'required|integer|max:10000000',
            'available' => 'required|boolean',
            'info' => 'required|max:1500',
        ]);
            // store
        $product = Product::find($id);
        $product->fill( $request->all() );
        $product->save();
        // redirect
        Session::flash('message', 'Successfully updated product!');
        return Redirect::to('products');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $product = Product::find($id);
        $product->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('products');
    }
}