<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types = ProductType::paginate(20);

        return View::make('product_types.index')->with('product_types', $product_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('product_types.create');
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
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
            'available' => 'required|boolean'
        ]);
        
        $product_type = new ProductType();
        $product_type->fill( $request->all() );
        $product_type->save();
    
        // redirect
        Session::flash('message', 'Successfully created product_type!');
        return Redirect::to('product_types');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_type = ProductType::find($id);

        return View::make('product_types.show')->with('product_type', $product_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_type = ProductType::find($id);

        return View::make('product_types.edit')->with('product_type', $product_type);
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
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
            'available' => 'required|boolean'
        ]);
        // store
        $product_type = ProductType::find($id);
        $product_type->fill( $request->all() );
        $product_type->save();
        // redirect
        Session::flash('message', 'Successfully updated product_type!');
        return Redirect::to('product_types');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $product_type = ProductType::find($id);
        $product_type->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('product_types');
    }
}