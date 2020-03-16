<?php

namespace App\Http\Controllers;

use App\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Value::paginate(20);

        return View::make('values.index')->with('values', $values);
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
        // validate
        $request->validate
        ([
            'name' => 'required|max:50'
        ]);
        
        $value = new Value();
        $value->fill( $request->all() );
        $value->save();
    
        // redirect
        Session::flash('message', 'Successfully created value!');
        return Redirect::to('values');
        
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate
        ([
            'name' => 'required|max:50'
        ]);
            // store
        $value = Value::find($id);
        $value->fill( $request->all() );
        $value->save();
        // redirect
        Session::flash('message', 'Successfully updated value!');
        return Redirect::to('values');
        
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
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('values');
    }
}