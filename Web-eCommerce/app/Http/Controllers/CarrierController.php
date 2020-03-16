<?php

namespace App\Http\Controllers;

use App\Carrier;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carriers = Carrier::paginate(20);

        return View::make('carriers.index')->with('carriers', $carriers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('carriers.create');
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
            'name' => 'required|max:45|unique:carriers,name',
            'image_ref' => 'required|max:255',
            'link' => 'required|max:2048',
            'details' => 'required',
        ]);
        
        $carrier = new Carrier();
        $carrier->fill( $request->all() );
        $carrier->save();
    
        // redirect
        Session::flash('message', 'Successfully created carrier!');
        return Redirect::to('carriers');
        
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrier = Carrier::find($id);

        return View::make('carriers.show')->with('carrier', $carrier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrier = Carrier::find($id);

        return View::make('carriers.edit')->with('carrier', $carrier);
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
            'link' => 'required|max:2048',
            'details' => 'required',
        ]);
            // store
        $carrier = Carrier::find($id);
        $carrier->fill( $request->all() );
        $carrier->save();
        // redirect
        Session::flash('message', 'Successfully updated carrier!');
        return Redirect::to('carriers');
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $carrier = Carrier::find($id);
        $carrier->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('carriers');
    }
}