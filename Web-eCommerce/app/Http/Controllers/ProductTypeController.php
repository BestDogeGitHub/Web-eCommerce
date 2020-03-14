<?php

namespace App\Http\Controllers;

use App\ProductType;
use App\Producer;
use Illuminate\Http\Request;
use Validator;

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

        return View('backoffice.pages.edit_product_types', ['productTypes' => $productTypes, 'producers' => $producers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'image' => 'required|image|max:4096',
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
        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images/product_types'), $new_name);

        $data = array(
            'name' => $request->name,
            'image_ref' => '/images/product_types/' . $new_name,
            'available' => 0,
            'star_rate' => 3,
            'n_reviews' => 0,
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
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        if(request()->ajax())
        {
            return response()->json(['data' => $productType]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        
        $rules = array(
            'producer' => 'required|numeric',
            'name' => 'required|max:200',
            'available' => 'required|numeric|between:0,1',
            'star_rate' => 'required|numeric|between:0,5',
            'n_reviews' => 'required|numeric'
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
                'star_rate' => $request->star_rate,
                'n_reviews' => $request->n_reviews,
                'producer_id' => $producer->id
            );

            

        } else {
            
            // IMAGE CHANGED
            
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('images/product_types'), $new_name);

            $data = array(
                'name' => $request->name,
                'image_ref' => '/images/product_types/' . $new_name,
                'available' => $request->available,
                'star_rate' => $request->star_rate,
                'n_reviews' => $request->n_reviews,
                'producer_id' => $producer->id
            ); 
        }
        
        $productType->update($data);
        
        return response()->json(['success' => 'Procut Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
    }
}
