<?php

namespace App\Http\Controllers;

use App\Nation;
use Illuminate\Http\Request;

class NationController extends Controller
{
    public function __construct()
        {
            $rules = array(
                'name' => 'required|max:70|alpha'
            );
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nations = Nation::all();

        return View('backoffice.pages.edit_nations', ['nations' => $nations]);
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
        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $nation = new Nation();
        $nation->fill( $request->all() );
        $nation->save();
    
        return response()->json(['success' => 'success!']);
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
        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $nation = Nation::find($id);
        $nation->fill( $request->all() );
        $nation->save();

        return response()->json(['success' => 'success!']);
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

        return response()->json(['success' => 'success!']);
    }
}