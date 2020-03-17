<?php

namespace App\Http\Controllers;

use App\Producer;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;

class ProducerController extends Controller
{

    protected $rules;

    public function __construct()
        {
            $this->rules = array(
                'name' => 'required|max:45',
                'image' => 'required|image|max:4096', // devo validare la dimensione dell'immagine
                'link' => 'required|max:2048',
                'details' => 'required'
            );
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producers = Producer::all();

        
        return View('backoffice.pages.edit_producers', ['producers' => $producers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('producers.create');
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
        
        if($error->fails()){ 
            return response()->json(['errors' => $error->errors()->all()]); 
        }

        // UPLOAD IMAGE
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images/producers'), $new_name);

        $data = array(
            'name' => $request->name,
            'image_ref' => '/images/producers/' . $new_name,
            'link' => $request->link,
            'details' => $request->details
        ); 

        // FOR DEBUGGING
        // return response()->json(['errors' => array_values($data)]);

        Producer::create($data);
        
        return response()->json(['success' => 'Product Type added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producer = Producer::find($id);

        return View::make('producers.show')->with('producer', $producer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Producer $producer)
    {
        if(request()->ajax())
        {
            return response()->json(['data' => $producer]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Producer $producer )
    {

        if(!$request->hasFile('image')) {

            // Smart copy of array
            $custom_rules = array_merge(array(), $this->rules);

            $custom_rules['image'] = 'image|max:4096';

            $error = Validator::make($request->all(), $custom_rules);

            if($error->fails()){ 
                return response()->json(['errors' => $error->errors()->all()]); 
            }

            $data = array(
                'name' => $request->name,
                'link' => $request->link,
                'details' => $request->details
            ); 

        } else {

            $error = Validator::make($request->all(), $this->rules);
            if($error->fails()){ 
                return response()->json(['errors' => $error->errors()->all()]); 
            }

            $data = array(
                'name' => $request->name,
                'link' => $request->link,
                'details' => $request->details
            ); 
            
            // IMAGE CHANGED
            
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('images/producers'), $new_name);

            

            

            $old_image_path = $producer->image_ref;
            if(File::exists(public_path() . $old_image_path)) {
                File::delete(public_path() . $old_image_path);
            }

            

            $data['image_ref'] = '/images/producers/' . $new_name;

            
        }
        
        $producer->update($data);
        
        return response()->json(['success' => 'Producer Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producer $producer)
    {

        $image_path = $producer->image_ref;
        if($producer->delete()){
            if(File::exists(public_path() . $image_path)) {
                File::delete(public_path() . $image_path);
            }
        }
    }
}