<?php

namespace App\Http\Controllers;

use App\ProductImage;
use Illuminate\Http\Request;
use Validator;
use Image;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{

    protected $rules;

    public function __construct()
    {
        $this->rules = array(
            'image' => 'required|image|max:4096',
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
        $error = Validator::make($request->all(), $this->rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        
        // UPLOAD IMAGE
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension(); // Name of new Image
        $destination_path = "/images/products";


        
        $resize_image = Image::make($image->getRealPath());

        
        $dimension = max($resize_image->width(), $resize_image->height());

        // we need to resize image, otherwise it will be cropped 

        if ($resize_image->width() > $dimension) { 
            $resize_image->resize($dimension, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if ($resize_image->height() > $dimension) {
            $resize_image->resize(null, $dimension, function ($constraint) {
                $constraint->aspectRatio();
            }); 
        }

        

        $resize_image->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');

        //return response()->json(['errors' => [$destination_path . '/' . $new_name]]);
        $resize_image->save(public_path($destination_path . '/' . $new_name));

        

        

        //$resize_image->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');


        //$image->move(public_path('images/products'), $new_name);

        

        $data = array(
            'image_ref' => '/images/products/' . $new_name,
            'product_id' => $request->product_id
        ); 

        ProductImage::create($data);

        return response()->json(['success' => 'Image added succesfully!']);
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
    public function edit(ProductImage $productImage)
    {
        if(request()->ajax())
        {
            return response()->json(['data' => $productImage]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, ProductImage $productImage )
    {
        $error = Validator::make($request->all(), $this->rules);
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
    public function destroy(ProductImage $productImage)
    {
        $image_path = $productImage->image_ref;
        if($productImage->delete()){
            if(File::exists(public_path() . $image_path)) {
                File::delete(public_path() . $image_path);
            }
        }
    }
}