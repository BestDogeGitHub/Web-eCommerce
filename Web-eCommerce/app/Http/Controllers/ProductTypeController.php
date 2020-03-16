<?php

namespace App\Http\Controllers;

use App\ProductType;
use App\Producer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
<<<<<<< HEAD
        $product_types = ProductType::paginate(20);

        return View::make('product_types.index')->with('product_types', $product_types);
=======
        $productTypes = ProductType::all();
        $producers = Producer::all();

        return View('backoffice.pages.edit_product_types', ['productTypes' => $productTypes, 'producers' => $producers]);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
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
<<<<<<< HEAD
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
        
=======
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
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
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
<<<<<<< HEAD
        $product_type = ProductType::find($id);

        return View::make('product_types.edit')->with('product_type', $product_type);
=======
        if(request()->ajax())
        {
            return response()->json(['data' => $productType]);
        }
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
<<<<<<< HEAD
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
        
=======
        
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

            $old_image_path = $productType->image_ref;
            if(File::exists(public_path() . $old_image_path)) {
                File::delete(public_path() . $old_image_path);
            }

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
        
        return response()->json(['success' => 'Product Type Updated successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        // delete
        $product_type = ProductType::find($id);
        $product_type->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('product_types');
=======
        $image_path = $productType->image_ref;
        if($productType->delete()){
            if(File::exists(public_path() . $image_path)) {
                File::delete(public_path() . $image_path);
            }
        }
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}