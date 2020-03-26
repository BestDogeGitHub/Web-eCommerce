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

Route::get('/', 'FrontEnd\ShopController@index')->name('/');
Route::get('products/{type}', 'FrontEnd\ShopController@getProductsFromType')->name('products');
Route::get('products/details/{id}', 'FrontEnd\ProductDetailController@show')->name('product_detail');
Route::get('carriers/{id}', 'FrontEnd\ProductDetailController@showCarrier')->name('carrier_detail');

Route::group(['middleware' => ['auth']], function () {

    /**
     * WISHLIST ROUTES
     */
    Route::get('shop/wishlist', 'FrontEnd\ShopUserController@getWishlist')->name('wishlist');
    Route::delete('shop/wishlist/{id}', 'FrontEnd\ShopUserController@removeFromWishlist')->name('remove_from_wishlist');
    Route::post('shop/wishlist', 'FrontEnd\ShopUserController@addToWishlist')->name('add_to_wishlist');

    /**
     * CART ROUTES
     */
    Route::get('shop/cart', 'FrontEnd\ShopUserController@getCart')->name('cart');
    Route::delete('shop/cart/{id}', 'FrontEnd\ShopUserController@removeFromCart')->name('remove_from_cart');
    Route::post('shop/cart', 'FrontEnd\ShopUserController@addToCart')->name('add_to_cart');
    Route::post('shop/cart/{id}/quantity', 'FrontEnd\ShopUserController@setQuantityCart')->name('set_product_quantity_cart');

    /**
     * CHECKOUT
     */
    Route::get('shop/checkout', 'FrontEnd\ShopUserController@getCheckout')->name('checkout');
    Route::post('shop/coupons/check', 'FrontEnd\ShopUserController@checkCoupon')->name('check_coupon');

    /**
     * ORDERS
     */
    Route::post('shop/make_order', 'FrontEnd\ShopUserController@makeOrder')->name('make_order');
    Route::get('shop/orders/', 'FrontEnd\ShopUserController@showOrders')->name('orders');

});

/**
 * SHOP ROUTES
 */
Route::get('shop/categories', 'FrontEnd\ShopController@getCategoriesView')->name('shop_categories')->defaults('parent', 0);
Route::get('shop/categories/{parent}', 'FrontEnd\ShopController@getCategoriesView')->name('categories_par');
Route::get('shop/{category}', 'FrontEnd\ShopController@getCatalogoCategory')->name('products_category');
Route::post('shop/search/', 'FrontEnd\ShopController@searchProductTypes')->name('search_product_types');
Route::get('shop', 'FrontEnd\ShopController@getShop')->name('shop');



Route::get('invoices/{id}/print', 'InvoiceController@getPDF')->name('getInvoicePDF');





/**
 * 
 * ADMIN USERS ROUTES
 * 
 * queste route si gestiscono tutte le chiamate delle varie risorse ref:
 * https://laravel.com/docs/master/controllers#resource-controllers
 */

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
            'productImages' => 'ProductImageController', //Implemented
            'productTypes' => 'ProductTypeController',  //Implemented
            'reviews' => 'ReviewController',
            'shipments' => 'ShipmentController',   //Implemented
            'towns' => 'TownController',
            'users' => 'UserController',
            'values' => 'ValueController'
        ]);

        Route::get('roles', 'FrontEnd\AdminDashboardController@manageRoles')->name('manageRoles');
        Route::get('home', 'FrontEnd\AdminDashboardController@index')->name('dashboard');
        Route::get('categories/properties', 'FrontEnd\AdminDashboardController@editProperties')->name('dashboard.properties');
        Route::get('roles/edit/{id}', 'FrontEnd\AdminDashboardController@editUserRoles')->name('editUserRoles');
        Route::post('roles/edit/{id}', 'FrontEnd\AdminDashboardController@changeUserRoles');
        Route::post('products/{id}/images', 'ProductController@getImages')->name('getProductImages');
        Route::get('products/{id}/properties', 'ProductController@getProperties')->name('getProductProperties');
        Route::post('products/{id}/properties', 'ProductController@addValue')->name('addProperty');
        Route::delete('products/{id}/properties/{value}', 'ProductController@removeValue')->name('removeProperty');
        Route::get('attributes/{id}/values', 'AttributeController@getValues')->name('getValuesByAttribute');
        Route::get('products/{id}/images', 'ProductController@redirectToProductImages')->name('redirectToProductImages');
        Route::get('users/edit/{id}', 'FrontEnd\AdminDashboardController@editUser')->name('editUser');
        
    });
});
