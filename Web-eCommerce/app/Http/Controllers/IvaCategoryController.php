<?php

namespace App\Http\Controllers;

use App\IvaCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class IvaCategoryController extends Controller
{

    protected $rules;

    public function __construct()
    {
        $this->rules = array(
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
        $ivaCategories = IvaCategory::all();

        return View('backoffice.pages.edit_iva_categories', ['ivaCategories' => $ivaCategories]);
        
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
        $error = Validator::make($request->all(), $this->rules);
        
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'category' => $request->category,
            'value' => $request->value
        ); 

        

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        IvaCategory::create($data);
        

        return response()->json(['success' => 'Category Added successfully.']);
        
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
    public function edit(IvaCategory $ivaCategory)
    {
        if(request()->ajax())
        {
            return response()->json([
                'data' => $ivaCategory
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, IvaCategory $ivaCategory )
    {
        $error = Validator::make($request->all(), $this->rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'category' => $request->category,
            'value' => $request->value
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $ivaCategory->update($data);
        

        return response()->json(['success' => 'Category Updated successfully.']);
        
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(IvaCategory $ivaCategory)
    {
        $ivaCategory->delete();
    }
}