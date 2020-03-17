<?php

namespace App\Http\Controllers;

use App\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function __construct()
        {
            $rules = array(
                'name' => 'required|max:45',
                'image_ref' => 'required|max:255',
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
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
        
        $producer = new Producer();
        $producer->fill( $request->all() );
        $producer->save();
    
        return response()->json(['success' => 'success!']);
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
        $error = Validator::make($request->all(), $rules);
        if($error->fails()){ return response()->json(['errors' => $error->errors()->all()]); }
            // store
        $producer = Producer::find($id);
        $producer->fill( $request->all() );
        $producer->save();

        return response()->json(['success' => 'success!']);
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

        return response()->json(['success' => 'success!']);
    }
}