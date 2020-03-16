<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::paginate(20);

        return View::make('attributes.index')->with('attributes', $attributes);
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
        // validate
        $request->validate
        ([
            'name' => 'required|max:100',
        ]);
        
        $attribute = new Attribute();
        $attribute->fill( $request->all() );
        $attribute->save();
    
        // redirect
        Session::flash('message', 'Successfully created attribute!');
        return Redirect::to('attributes');
        
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
        $attribute = Attribute::find($id);

        return View::make('attributes.edit')->with('attribute', $attribute);
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
            'name' => 'required|max:100',
        ]);
            // store
        $attribute = Attribute::find($id);
        $attribute->fill( $request->all() );
        $attribute->save();
        // redirect
        Session::flash('message', 'Successfully updated attribute!');
        return Redirect::to('attributes');
        
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