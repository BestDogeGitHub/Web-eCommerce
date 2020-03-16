<?php

namespace App\Http\Controllers;

use App\Nation;
use Illuminate\Http\Request;

class NationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nations = Nation::paginate(20);

        return View::make('nations.index')->with('nations', $nations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('nations.create');
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
            'name' => 'required|max:70|alpha'
        ]);
        
        $nation = new Nation();
        $nation->fill( $request->all() );
        $nation->save();
    
        // redirect
        Session::flash('message', 'Successfully created nation!');
        return Redirect::to('nations');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nation = Nation::find($id);

        return View::make('nations.show')->with('nation', $nation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nation = Nation::find($id);

        return View::make('nations.edit')->with('nation', $nation);
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
            'name' => 'required|max:70|alpha'
        ]);
            // store
        $nation = Nation::find($id);
        $nation->fill( $request->all() );
        $nation->save();
        // redirect
        Session::flash('message', 'Successfully updated nation!');
        return Redirect::to('nations');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $nation = Nation::find($id);
        $nation->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('nations');
    }
}