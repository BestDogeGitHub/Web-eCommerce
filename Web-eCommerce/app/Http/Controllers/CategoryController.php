<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(20);

        return View::make('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('categories.create');
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
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
        ]);
        
        $category = new Category();
        $category->fill( $request->all() );
        $category->save();
    
        // redirect
        Session::flash('message', 'Successfully created category!');
        return Redirect::to('categories');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return View::make('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return View::make('categories.edit')->with('category', $category);
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
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
        ]);
            // store
        $category = Category::find($id);
        $category->fill( $request->all() );
        $category->save();
        // redirect
        Session::flash('message', 'Successfully updated category!');
        return Redirect::to('categories');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $category = Category::find($id);
        $category->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('categories');
    }
}