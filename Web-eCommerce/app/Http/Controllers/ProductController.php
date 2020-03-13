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
        $products = Product::orderByDesc('created_at')->get();
        $productTypes = ProductType::all();
        $ivas = IvaCategory::all();

        return View('backoffice.pages.crud_products', ['products' => $products, 'productTypes' => $productTypes, 'ivas' => $ivas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
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
    }
}
