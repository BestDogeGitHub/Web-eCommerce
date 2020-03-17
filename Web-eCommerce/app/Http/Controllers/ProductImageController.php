<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function __construct()
    {
        $rules = array(
            'image_ref' => 'required|max:255',
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
        $product_images = ProductImage::all();

        return View('backoffice.pages.edit_product_images', ['product_images' => $product_images]);
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
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }

        $product_image = new ProductImage();
        $product_image->fill( $request->all() );
        $product_image->save();
    
        return response()->json(['success' => 'success!']);
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
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        
        $product_image = ProductImage::find($id);
        $product_image->fill( $request->all() );
        $product_image->save();

        return response()->json(['success' => 'success!']);
        
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

        return response()->json(['success' => 'success!']);
    }
}