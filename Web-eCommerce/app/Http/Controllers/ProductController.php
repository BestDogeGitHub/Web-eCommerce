<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\IvaCategory;
use App\Attribute;
use App\Value;
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

        return View('backoffice.pages.edit_products', ['products' => $products, 'productTypes' => $productTypes, 'ivas' => $ivas]);
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
        $rules = array(
            'payment' => 'required|numeric|between:0,99999.999',
            'sale' => 'required|numeric|max:100',
            'stock' => 'required|numeric|max:10000000',
            'info' => 'required|max:500',
            'productType' => 'required|integer|min:0|exists:product_types,id',
            'ivaCategory' => 'required|integer|min:0|exists:iva_categories,id'
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
        

        return response()->json(['success' => 'Product Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $frontController = new \App\Http\Controllers\FrontEnd\ProductDetailController();
        
        return $frontController->show($product->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(request()->ajax())
        {
            return response()->json(['data' => $product]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Product $product )
    {
        $rules = array(
            'productType' => 'required',
            'ivaCategory' => 'required',
            'payment' => 'required|numeric|between:0,99999.999',
            'sale' => 'required|numeric|max:100',
            'stock' => 'required|numeric',
            'info' => 'required|max:500',
            'available' => 'required|numeric|between:0,1',
            'product_type_id' => 'required|integer|min:0|exists:product_types,id',
            'iva_category_id' => 'required|integer|min:0|exists:iva_categories,id'
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
        
        return response()->json(['success' => 'Product Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
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
    }

    public static function getRelatedById($id)
    {
        $product = ProductController::getById($id);
        return Product::where([
            ['product_type_id', '=' , $product->productType->id],
            ['id', '!=' , $id]
            ])->take(4)->get();
    }

    /**
     * Get Images
     */
    public function getImages($id) 
    {

        

        if(request()->ajax())
        {
            $product = Product::findOrFail($id);
            $productType = $product->productType->name;
            $productImages = $product->productImages;

            if (!count($productImages))
            {
                $productImages = '';
            }
            return response()->json([
                'images' => $productImages,
                'product' => $product,
                'product_type' => $productType
            ]);
        }
    }

    public function getProperties($id) 
    {

        $product = Product::findOrFail($id);
        $attributes = Attribute::all();
        
        return View('backoffice.pages.edit_product_properties', ['product' => $product, 'attributes' => $attributes]);
    }

    public function addValue($id, Request $request) 
    {

        $rules = array([
            'value_id' => 'required|integer|exists:values,id'
        ]);

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        

        $product = Product::findOrFail($id);
        $value = Value::findOrFail($request->value_id);

        $product->values()->attach($value);

        return response()->json(['success' => 'Property Added successfully.']);
    }

    public function removeValue($id, $value)
    {
        $product = Product::findOrFail($id);
        $value = Value::findOrFail($value);

        $product->values()->detach($value);
    }

    public function redirectToProductImages($id) 
    {
        $product = Product::findOrFail($id);
        return View('backoffice.pages.edit_product_images', ['product' => $product]);
    }

    
}