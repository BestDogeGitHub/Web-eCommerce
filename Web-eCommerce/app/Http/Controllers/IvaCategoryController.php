<?php

namespace App\Http\Controllers;

use App\IvaCategory;
use Illuminate\Http\Request;

class IvaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iva_categories = IvaCategory::paginate(20);

        return View::make('iva_categories.index')->with('iva_categories', $iva_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('iva_categories.create');
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
            'category' => 'required|max:45',
            'value' => 'required|integer|max:100',
        ]);
        
        $iva_category = new IvaCategory();
        $iva_category->fill( $request->all() );
        $iva_category->save();
    
        // redirect
        Session::flash('message', 'Successfully created iva_category!');
        return Redirect::to('iva_categories');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $iva_category = IvaCategory::find($id);

        return View::make('iva_categories.show')->with('iva_category', $iva_category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $iva_category = IvaCategory::find($id);

        return View::make('iva_categories.edit')->with('iva_category', $iva_category);
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
            'category' => 'required|max:45',
            'value' => 'required|integer|max:100',
        ]);
            // store
        $iva_category = IvaCategory::find($id);
        $iva_category->fill( $request->all() );
        $iva_category->save();
        // redirect
        Session::flash('message', 'Successfully updated iva_category!');
        return Redirect::to('iva_categories');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $iva_category = IvaCategory::find($id);
        $iva_category->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('iva_categories');
    }
}