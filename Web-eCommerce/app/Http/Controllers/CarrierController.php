<?php

namespace App\Http\Controllers;

use App\Carrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $carriers = Carrier::paginate(20);

        return View::make('carriers.index')->with('carriers', $carriers);
=======
        $carriers = Carrier::all();

        return View('backoffice.pages.edit_carriers', ['carriers' => $carriers]);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('carriers.create');
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
            'name' => 'required|max:45|unique:carriers,name',
            'image_ref' => 'required|max:255',
            'link' => 'required|max:2048',
            'details' => 'required',
        ]);
        
        $carrier = new Carrier();
        $carrier->fill( $request->all() );
        $carrier->save();
    
        // redirect
        Session::flash('message', 'Successfully created carrier!');
        return Redirect::to('carriers');
        
=======
        $rules = array(
            'name' => 'required',
            'image' => 'required|image|max:4096',
            'link' => 'required|string|max:1000',
            'details' => 'required|string|max:3000'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        // UPLOAD IMAGE
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images/carriers'), $new_name);

        $data = array(
            'name' => $request->name,
            'image_ref' => '/images/carriers/' . $new_name,
            'link' => $request->link,
            'details' => $request->details
        ); 

        // FOR DEBUGGING
        // return response()->json(['errors' => array_values($data)]);

        Carrier::create($data);
        
        return response()->json(['success' => 'Carrier added successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = Carrier::find($id);

        return View::make('carriers.show')->with('carrier', $carrier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $carrier = Carrier::find($id);

        return View::make('carriers.edit')->with('carrier', $carrier);
=======
        if(request()->ajax())
        {
            return response()->json([
                'data' => $carrier
            ]);
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
            'link' => 'required|max:2048',
            'details' => 'required',
        ]);
            // store
        $carrier = Carrier::find($id);
        $carrier->fill( $request->all() );
        $carrier->save();
        // redirect
        Session::flash('message', 'Successfully updated carrier!');
        return Redirect::to('carriers');
        
=======
        $rules = array(
            'name' => 'required',
            'link' => 'required|string|max:1000',
            'details' => 'required|string|max:3000'
        );
        
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        
        if(!$request->hasFile('image')) {
            
            // IMAGE NOT CHANGED
            
            $data = array(
                'name' => $request->name,
                'image_ref' => $carrier->image_ref,
                'link' => $request->link,
                'details' => $request->details
            );

            

        } else {
            
            // IMAGE CHANGED
            
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('images/carriers'), $new_name);


            $image_path = $carrier->image_ref;


            if(File::exists(public_path() . $image_path)) {
                
                File::delete(public_path() . $image_path);
            }

            $data = array(
                'name' => $request->name,
                'image_ref' => '/images/carriers/' . $new_name,
                'link' => $request->link,
                'details' => $request->details
            ); 
        }
        
        $carrier->update($data);
        
        return response()->json(['success' => 'Carrier Updated successfully.']);
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
        $carrier = Carrier::find($id);
        $carrier->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('carriers');
=======
        $image_path = $carrier->image_ref;
        if($carrier->delete()){
            if(File::exists(public_path() . $image_path)) {
                File::delete(public_path() . $image_path);
            }
        }
    }

    /**
     * Return the specified resource.
     *
     * @param  $id
     * @return \App\Carrier
     */
    public static function getById($id)
    {
        return Carrier::where('id', $id)->first();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}