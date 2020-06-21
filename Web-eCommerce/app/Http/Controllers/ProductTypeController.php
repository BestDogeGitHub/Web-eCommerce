<?php

namespace App\Http\Controllers;

use App\ProductType;
use App\Producer;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;
use Image;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productTypes = ProductType::all();
        $producers = Producer::all();
        $categories = Category::where('id', '!=', 1)->get();

        return View('backoffice.pages.edit_product_types', ['productTypes' => $productTypes, 'producers' => $producers, 'categories' => $categories]);
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
        $rules = array(
            'name' => 'required|max:45',
            'image' => 'required|image|max:4096', 
            // 'available' => 'required|boolean', // AL MOMENTO DELLO STORE è A 0
            'producer' => 'required|numeric',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        
        // CHECK PRODUCER
        $producer = Producer::findOrFail($request->producer);

        // UPLOAD IMAGE
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension(); // Name of new Image
        $destination_path = "/images/product_types";

        
        
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

        

        $data = array(
            'name' => $request->name,
            'image_ref' => '/images/product_types/' . $new_name,
            'available' => 0,
            'star_tot_number' => 3,
            'producer_id' => $producer->id
        ); 

        // FOR DEBUGGING
        // return response()->json(['errors' => array_values($data)]);

        ProductType::create($data);
        
        return response()->json(['success' => 'Product Type added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        $product_type = ProductType::find($id);

        return View::make('product_types.show')->with('product_type', $product_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $productType,
                'categories' => $productType->categories
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, ProductType $productType )
    {
        
        $rules = array(
            'producer' => 'required|numeric',
            'name' => 'required|max:200',
            'available' => 'required|numeric|between:0,1',
        );
        
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        

        // CHECK PRODUCER
        $producer = Producer::findOrFail($request->producer);
        
        if(!$request->hasFile('image')) {
            
            // IMAGE NOT CHANGED
            
            $data = array(
                'name' => $request->name,
                'image_ref' => $productType->image_ref,
                'available' => $request->available,
                'producer_id' => $producer->id
            );

            

        } else {
            
            // IMAGE CHANGED
            
            // UPLOAD IMAGE
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension(); // Name of new Image
            $destination_path = "/images/product_types";


            
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


            $old_image_path = $productType->image_ref;
            if(File::exists(public_path() . $old_image_path)) {
                File::delete(public_path() . $old_image_path);
            }

            $data = array(
                'name' => $request->name,
                'image_ref' => '/images/product_types/' . $new_name,
                'available' => $request->available,
                'producer_id' => $producer->id
            ); 
        }
        
        

        if(isset($request->categories)) {
            $productType->categories()->sync($request->categories);
            //foreach($request->categories as $category_id) {
                //$productType Category::findOrFail($category_id);
                
            //}
        }

        $productType->update($data);
        
        return response()->json(['success' => 'Product Type Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $image_path = $productType->image_ref;
        if($productType->delete()){
            if(File::exists(public_path() . $image_path)) {
                File::delete(public_path() . $image_path);
            }
        }
    }

    public static function search($string)
    {
        $lowerString = strtolower($string);
        $words = explode(' ',$lowerString);
        $productTypes = ProductType::all();

        $productTypes->map(function ($productType) { $productType['count'] = 0; });

        foreach ($productTypes as $productType) 
        {
            foreach ($words as $word) 
            {
                $lowerName = strtolower($productType->name);
                if( strlen($word) > 3 ) { if (strpos($lowerName, $word) !== false) $productType->count++ ; }
                else { if (preg_match("/\b{$word}\b/",$lowerName)) $productType->count++; }
            }
        }

        $filtered = $productTypes->whereNotIn('count', [0]);
        $ordered = $filtered->sortByDesc('count');
        
        $orderedWithoutCount = $ordered->map(function ($post)
        {
            unset($post['count']);
            return $post;
        });
        return $orderedWithoutCount;
    }
}