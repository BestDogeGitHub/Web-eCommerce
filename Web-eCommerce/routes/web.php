<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'FrontEnd\ShopController@index')->name('nome');
Route::get('products/{type}', 'FrontEnd\ShopController@getProductsFromType')->name('products');
Route::get('products/details/{id}', 'FrontEnd\ProductDetailController@show')->name('product_detail');
Route::get('carriers/{id}', 'FrontEnd\ProductDetailController@showCarrier')->name('carrier_detail');
Route::get('shop/categories', 'FrontEnd\ShopController@getCategoriesView')->name('shop_categories')->defaults('parent', 0);
Route::get('shop/categories/{parent}', 'FrontEnd\ShopController@getCategoriesView')->name('categories_par');
Route::get('shop', 'FrontEnd\ShopController@getShop')->name('shop');
Route::get('shop/{category}', 'FrontEnd\ShopController@getCatalogoCategory')->name('products_category');

Route::get('admin', function () {
    return view('backoffice.pages.home');
});

Route::get('auth/roles', 'FrontEnd\AdminDashboardController@manageRoles')->name('manageRoles');
Route::get('auth/home', 'FrontEnd\AdminDashboardController@index')->name('dashboard');
Route::get('auth/categories/properties', 'FrontEnd\AdminDashboardController@editProperties')->name('dashboard.properties');
Route::get('auth/roles/edit/{id}', 'FrontEnd\AdminDashboardController@editUserRoles')->name('editUserRoles');
Route::post('auth/roles/edit/{id}', 'FrontEnd\AdminDashboardController@changeUserRoles');
Route::post('auth/products/{id}/images', 'ProductController@getImages')->name('getProductImages');
Route::get('auth/products/{id}/images', 'ProductController@redirectToProductImages')->name('redirectToProductImages');
Route::get('auth/users/edit/{id}', 'FrontEnd\AdminDashboardController@editUser')->name('editUser');
Route::get('auth/products', 'ProductController@index');

Route::get('invoices/{id}/print', 'InvoiceController@getPDF')->name('getInvoicePDF');


// queste route si gestiscono tutte le chiamate delle varie risorse ref: 
// https://laravel.com/docs/master/controllers#resource-controllers
Route::prefix('auth')->group(function () {
    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::resources([
            'addresses' => 'AddressController', //Implemented         
            'attributes' => 'AttributeController',   //Implemented
            'carriers' => 'CarrierController',  //Implemented
            'categories' => 'CategoryController',   //Implemented
            'creditCards' => 'CreditCardController',    //Implemented
            'deliveryStatuses' => 'DeliveryStatusController', //Implemented
            'invoices' => 'InvoiceController',      //Implemented
            'ivaCategories' => 'IvaCategoryController', //Implemented
            'nations' => 'NationController',    //Implemented
            'orders' => 'OrderController',  //Implemented
            'orderDetails' => 'OrderDetailController',  //Implemented
            'paymentMethods' => 'PaymentMethodController', //Implemented
            'producers' => 'ProducerController',    //Implemented
            'products' => 'ProductController',  //Implemented
            'productImages' => 'ProductImageController', 
            'productTypes' => 'ProductTypeController',  //Implemented
            'reviews' => 'ReviewController',
            'shipments' => 'ShipmentController',
            'towns' => 'TownController',
            'users' => 'UserController',
            'values' => 'ValueController'
        ]);
        
    });
});
