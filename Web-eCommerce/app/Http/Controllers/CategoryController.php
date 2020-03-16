<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $categories = Category::paginate(20);

        return View::make('categories.index')->with('categories', $categories);
=======
        $categories = Category::all();

        return View('backoffice.pages.edit_categories', ['categories' => $categories]);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('categories.create');
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
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
        ]);
        
        $category = new Category();
        $category->fill( $request->all() );
        $category->save();
    
        // redirect
        Session::flash('message', 'Successfully created category!');
        return Redirect::to('categories');
        
=======
        $rules = array(
            'name' => 'required|string|min:1',
            'image' => 'required|image|max:4096',
            'parent_id' => 'required'
        );
        
        $error = Validator::make($request->all(), $rules);
        
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $parent = Category::findOrFail($request->parent_id);

        // UPLOAD IMAGE
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images/categories'), $new_name);

        $data = array(
            'name' => $request->name,
            'image_ref' => '/images/categories/' . $new_name,
        ); 

        // FOR DEBUGGING
        //return response()->json(['errors' => array_values($data)]);

        $parent->children()->create($data);
        

        return response()->json(['success' => 'Category Added successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return View::make('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $category = Category::find($id);

        return View::make('categories.edit')->with('category', $category);
=======
        if(request()->ajax())
        {
            $numberProducts = $category->productTypes->count();
            return response()->json([
                'data' => $category,
                'products' => $numberProducts
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
            'name' => 'required|max:45',
            'image_ref' => 'required|max:255',
        ]);
            // store
        $category = Category::find($id);
        $category->fill( $request->all() );
        $category->save();
        // redirect
        Session::flash('message', 'Successfully updated category!');
        return Redirect::to('categories');
=======
        $rules = array(
            'name' => 'required|string|min:1',
            'parent_id' => 'required'
        );
        
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        // CHECK PARENT
        $parent = Category::findOrFail($request->parent_id);
        
        if(!$request->hasFile('image')) {
            
            // IMAGE NOT CHANGED
            
            $data = array(
                'name' => $request->name,
                'image_ref' => $category->image_ref
            );

        } else {
            
            // IMAGE CHANGED
            
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('images/categories'), $new_name);

            $old_image_path = $category->image_ref;

            if(File::exists(public_path() . $old_image_path)) {
                File::delete(public_path() . $old_image_path);
            }

            $data = array(
                'name' => $request->name,
                'image_ref' => '/images/categories/' . $new_name,
            ); 
        }

        if($parent->id == $category->parent_id) {
            $category->update($data);
            return response()->json(['success' => 'Category Updated successfully.']);
        }
        else {
            $category->delete();
            $parent->children()->create($data);
            return response()->json(['success' => 'Category Updated and Moved successfully.']);
        }
        
        
        
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
        $category = Category::find($id);
        $category->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('categories');
=======
        $image_path = $category->image_ref;
        if($category->delete()){
            if(File::exists(public_path() . $image_path)) {
                File::delete(public_path() . $image_path);
            }
        }
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}