<?php

namespace App\Http\Controllers;

use App\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towns = Town::paginate(20);

        return View::make('towns.index')->with('towns', $towns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('towns.create');
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
            'name' => 'required|alpha|max:50'
        ]);
        
        $town = new Town();
        $town->fill( $request->all() );
        $town->save();
    
        // redirect
        Session::flash('message', 'Successfully created town!');
        return Redirect::to('towns');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $town = Town::find($id);

        return View::make('towns.show')->with('town', $town);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $town = Town::find($id);

        return View::make('towns.edit')->with('town', $town);
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
            'name' => 'required|alpha|max:50'
        ]);
            // store
        $town = Town::find($id);
        $town->fill( $request->all() );
        $town->save();
        // redirect
        Session::flash('message', 'Successfully updated town!');
        return Redirect::to('towns');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $town = Town::find($id);
        $town->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('towns');
    }
}