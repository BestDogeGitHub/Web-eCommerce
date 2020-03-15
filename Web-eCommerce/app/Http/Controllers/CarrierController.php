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
        $carriers = Carrier::all();

        return View('backoffice.pages.edit_carriers', ['carriers' => $carriers]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function show(Carrier $carrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrier $carrier)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $carrier
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrier $carrier)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrier $carrier)
    {
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
    }
}
