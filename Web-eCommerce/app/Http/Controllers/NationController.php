<?php

namespace App\Http\Controllers;

use App\Nation;
use Illuminate\Http\Request;
use Validator;

class NationController extends Controller
{
    protected $rules;

    public function __construct()
        {
            $this->rules = array(
                'name' => 'required|max:70' // Se metti alpha nella validazione non prende gli spazi
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
        $error = Validator::make($request->all(), $this->rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $data = array(
            'name' => $request->name
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        Nation::create($data);
        

        return response()->json(['success' => 'Nation Added successfully.']);
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
    public function edit(Nation $nation)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $nation
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Nation $nation )
    {
        $error = Validator::make($request->all(), $this->rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $data = array(
            'name' => $request->name
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $nation->update($data);
        

        return response()->json(['success' => 'Nation Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nation $nation)
    {
        $nation->delete();
    }
}