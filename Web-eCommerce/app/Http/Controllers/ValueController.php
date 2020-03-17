<?php

namespace App\Http\Controllers;

use App\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    public function __construct()
        {
            $rules = array(
                'name' => 'required|max:50',
                'attribute_id' => 'required|integer|min:0|exists:attributes,id'
            );
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Value::all();

        return View('backoffice.pages.edit_values', ['values' => $values]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('values.create');
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
        
        $value = new Value();
        $value->fill( $request->all() );
        $value->save();
    
        return response()->json(['success' => 'success!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $value = Value::find($id);

        return View::make('values.show')->with('value', $value);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = Value::find($id);

        return View::make('values.edit')->with('value', $value);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
            // store
        $value = Value::find($id);
        $value->fill( $request->all() );
        $value->save();

        return response()->json(['success' => 'success!']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $value = Value::find($id);
        $value->delete();

        return response()->json(['success' => 'success!']);
    }
}