<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;
use Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();

        return View('backoffice.pages.edit_attributes', ['attributes' => $attributes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('attributes.create');
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
            'name' => 'required|string|min:1|max:100'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'name' => $request->name
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        Attribute::create($data);
        

        return response()->json(['success' => 'Attribute Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::find($id);

        return View::make('attributes.show')->with('attribute', $attribute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $attribute
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $rules = array(
            'name' => 'required|string|min:1|max:100'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'name' => $request->name
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $attribute->update($data);
        

        return response()->json(['success' => 'Attribute Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $attribute = Attribute::find($id);
        $attribute->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('attributes');
    }
}