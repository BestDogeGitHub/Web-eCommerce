<?php

namespace App\Http\Controllers;

use App\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producers = Producer::paginate(20);

        return View::make('producers.index')->with('producers', $producers);
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
        // validate
        $request->validate
        ([
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
            'link' => 'required|max:2048',
            'details' => 'required',
        ]);
        
        $producer = new Producer();
        $producer->fill( $request->all() );
        $producer->save();
    
        // redirect
        Session::flash('message', 'Successfully created producer!');
        return Redirect::to('producers');
        
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
    public function edit($id)
    {
        $producer = Producer::find($id);

        return View::make('producers.edit')->with('producer', $producer);
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
            'name' => 'required|max:45|unique:producers,name',
            'image_ref' => 'required|max:255',
            'link' => 'required|max:2048',
            'details' => 'required',
        ]);
            // store
        $producer = Producer::find($id);
        $producer->fill( $request->all() );
        $producer->save();
        // redirect
        Session::flash('message', 'Successfully updated producer!');
        return Redirect::to('producers');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $producer = Producer::find($id);
        $producer->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('producers');
    }
}