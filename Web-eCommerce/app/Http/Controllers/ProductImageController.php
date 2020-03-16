<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_images = ProductImage::paginate(20);

        return View::make('product_images.index')->with('product_images', $product_images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('product_images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_image = new ProductImage();
        $product_image->fill( $request->all() );
        $product_image->save();
    
        // redirect
        Session::flash('message', 'Successfully created product_image!');
        return Redirect::to('product_images');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_image = ProductImage::find($id);

        return View::make('product_images.show')->with('product_image', $product_image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_image = ProductImage::find($id);

        return View::make('product_images.edit')->with('product_image', $product_image);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $product_image = ProductImage::find($id);
        $product_image->fill( $request->all() );
        $product_image->save();
        // redirect
        Session::flash('message', 'Successfully updated product_image!');
        return Redirect::to('product_images');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $product_image = ProductImage::find($id);
        $product_image->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('product_images');
    }
}