<?php

namespace App\Http\Controllers;

use App\IvaCategory;
use Illuminate\Http\Request;

class IvaCategoryController extends Controller
{
    public function __construct()
    {
        $rules = array(
            'category' => 'required|max:45',
            'value' => 'required|integer|max:100|min:0',
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iva_categories = IvaCategory::all();

        return View('backoffice.pages.edit_iva_categories', ['iva_categories' => $iva_categories]);
        
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
        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $iva_category = new IvaCategory();
        $iva_category->fill( $request->all() );
        $iva_category->save();
    
        return response()->json(['success' => 'success']);
        
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
        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $iva_category = IvaCategory::find($id);
        $iva_category->fill( $request->all() );
        $iva_category->save();
        
        return response()->json(['success' => 'success']);
        
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

        return response()->json(['success' => 'success!']);
    }
}