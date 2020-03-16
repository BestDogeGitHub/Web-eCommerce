<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\IvaCategory;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $products = Product::paginate(20);

        return View::make('products.index')->with('products', $products);
=======
        $products = Product::orderByDesc('created_at')->get();
        $productTypes = ProductType::all();
        $ivas = IvaCategory::all();

        return View('backoffice.pages.edit_products', ['products' => $products, 'productTypes' => $productTypes, 'ivas' => $ivas]);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('products.create');
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
            'payment' => 'required|numeric',
            'sale' => 'required|integer|max:100',
            'stock' => 'required|integer|max:10000000',
            'available' => 'required|boolean',
            'info' => 'required|max:1500',
        ]);
        
        $product = new Product();
        $product->fill( $request->all() );
        $product->save();
    
        // redirect
        Session::flash('message', 'Successfully created product!');
        return Redirect::to('products');
        
=======
        $rules = array(
            'productType' => 'required',
            'ivaCategory' => 'required',
            'payment' => 'required|numeric|between:0,99999.999',
            'sale' => 'required|numeric|max:100',
            'stock' => 'required|numeric',
            'info' => 'required|max:500'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'payment' => $request->payment,
            'sale' => $request->sale,
            'stock' => $request->stock,
            'buy_counter' => 0,
            'available' => 1,
            'info' => $request->info,
            'product_type_id' => $request->productType,
            'iva_category_id' => $request->ivaCategory,
        ); 

        // FOR DEBUGGING
        // return response()->json(['errors' => array_values($data)]);

        Product::create($data);
        

        return response()->json(['success' => 'Procut Added successfully.']);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD
        $product = Product::find($id);

        return View::make('products.show')->with('product', $product);
=======
        $frontController = new \App\Http\Controllers\FrontEnd\ProductDetailController();
        
        return $frontController->show($product->id);
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        $product = Product::find($id);

        return View::make('products.edit')->with('product', $product);
=======
        if(request()->ajax())
        {
            return response()->json(['data' => $product]);
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
            'payment' => 'required|numeric',
            'sale' => 'required|integer|max:100',
            'stock' => 'required|integer|max:10000000',
            'available' => 'required|boolean',
            'info' => 'required|max:1500',
        ]);
            // store
        $product = Product::find($id);
        $product->fill( $request->all() );
        $product->save();
        // redirect
        Session::flash('message', 'Successfully updated product!');
        return Redirect::to('products');
        
=======
        $rules = array(
            'productType' => 'required',
            'ivaCategory' => 'required',
            'payment' => 'required|numeric|between:0,99999.999',
            'sale' => 'required|numeric|max:100',
            'stock' => 'required|numeric',
            'info' => 'required|max:500',
            'available' => 'required|numeric|between:0,1'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = array(
            'payment' => $request->payment,
            'sale' => $request->sale,
            'stock' => $request->stock,
            'buy_counter' => $product->buy_counter,
            'available' => $request->available,
            'info' => $request->info,
            'product_type_id' => $request->productType,
            'iva_category_id' => $request->ivaCategory,
        ); 

        $product->update($data);
        
        return response()->json(['success' => 'Procut Updated successfully.']);
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
        $product = Product::find($id);
        $product->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('products');
=======
        $product->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public static function getById($id)
    {
        return Product::where('id', $id)->first();
>>>>>>> 06d9a2a0e316e574eb97b9305e682be87c78c6ba
    }
}