<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;
use Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $attributes = Attribute::paginate(20);

        return View::make('attributes.index')->with('attributes', $attributes);
=======
        $attributes = Attribute::all();

        return View('backoffice.pages.edit_attributes', ['attributes' => $attributes]);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        // validate
        $request->validate
        ([
            'name' => 'required|max:100',
        ]);
        
        $attribute = new Attribute();
        $attribute->fill( $request->all() );
        $attribute->save();
    
        // redirect
        Session::flash('message', 'Successfully created attribute!');
        return Redirect::to('attributes');
        
=======
        
        $rules = array(
            'name' => 'required|string|min:1'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'name' => $request->name
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        Attribute::create($data);
        

        return response()->json(['success' => 'Attribute Added successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = Attribute::find($id);

        return View::make('attributes.show')->with('attribute', $attribute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $attribute = Attribute::find($id);

        return View::make('attributes.edit')->with('attribute', $attribute);
=======
        if(request()->ajax())
        {
            return response()->json([
                'data' => $attribute
            ]);
        }
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
<<<<<<< HEAD
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate
        ([
            'name' => 'required|max:100',
        ]);
            // store
        $attribute = Attribute::find($id);
        $attribute->fill( $request->all() );
        $attribute->save();
        // redirect
        Session::flash('message', 'Successfully updated attribute!');
        return Redirect::to('attributes');
        
=======
        $rules = array(
            'name' => 'required|string|min:1'
        );
        
        

        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'name' => $request->name
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $attribute->update($data);
        

        return response()->json(['success' => 'Attribute Updated successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        // delete
        $attribute = Attribute::find($id);
        $attribute->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('attributes');
=======
        $attribute->delete();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}