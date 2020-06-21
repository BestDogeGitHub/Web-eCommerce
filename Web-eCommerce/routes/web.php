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



Route::group(['middleware' => ['auth']], function () {


    /**
     * CHECKOUT
     */
    Route::group(['middleware' => ['can:checkout']], function () {
        Route::get('shop/checkout', 'FrontEnd\ShopUserController@getCheckout')->name('checkout');
        Route::post('shop/coupons/check', 'FrontEnd\ShopUserController@checkCoupon')->name('check_coupon');
    
        /**
         * ORDERS
         */
        Route::post('shop/make_order', 'FrontEnd\ShopUserController@makeOrder')->name('make_order');
        Route::get('shop/orders/', 'FrontEnd\ShopUserController@showOrders')->name('orders');
        Route::get('shop/orders/{id}/invoice', 'FrontEnd\ShopUserController@showInvoice')->name('show_invoice');
    });
    
    /**
     * PUBLIC PROFILES
     */
    Route::group(['middleware' => ['can:showPublicProfile']], function () {
        Route::get('shop/users/{id}', 'FrontEnd\AuthUserController@publicProfile')->name('get_public_profile');
    });


});


/**
 * WISHLIST ROUTES
 */
Route::get('shop/wishlist', 'FrontEnd\ShopUserController@getWishlist')->name('wishlist.index');
Route::delete('shop/wishlist/{id}', 'FrontEnd\ShopUserController@removeFromWishlist')->name('wishlist.destroy');
Route::post('shop/wishlist', 'FrontEnd\ShopUserController@addToWishlist')->name('wishlist.store');

/**
 * CART ROUTES
 */
Route::get('shop/cart', 'FrontEnd\ShopUserController@getCart')->name('cart');
Route::delete('shop/cart/{id}', 'FrontEnd\ShopUserController@removeFromCart')->name('remove_from_cart');
Route::post('shop/cart', 'FrontEnd\ShopUserController@addToCart')->name('add_to_cart');
Route::post('shop/cart/{id}/quantity', 'FrontEnd\ShopUserController@setQuantityCart')->name('set_product_quantity_cart');


/**
 * SHOP PUBLIC ROUTES [GET]
 */

// HomePage Route
Route::get('/', 'FrontEnd\ShopController@index')->name('/');   

// Products List by Type 
Route::get('products/{type}', 'FrontEnd\ShopController@getProductsFromType')->name('products');                             

// Product details by id
Route::get('products/details/{id}', 'FrontEnd\ProductDetailController@show')->name('product_detail');

// Carrier details by id
Route::get('carriers/{id}', 'FrontEnd\ShopController@showCarrier')->name('carrier_detail');

// Categories view
Route::get('shop/categories', 'FrontEnd\ShopController@getCategoriesView')->name('shop_categories')->defaults('parent', 0);
Route::get('shop/categories/{parent}', 'FrontEnd\ShopController@getCategoriesView')->name('categories_par');

// Get product types from category
Route::get('shop/{category}', 'FrontEnd\ShopController@getCatalogoCategory')->name('products_category');

// Get main shop view (all products)
Route::get('shop', 'FrontEnd\ShopController@getShop')->name('shop');

// Get printable page of invoice
Route::get('invoices/{id}/print', 'InvoiceController@getPDF')->name('getInvoicePDF');



/**
 * SHOP PUBLIC ROUTES [POST]
 */

// Add review to product route
Route::post('product/details/{id}/addReview', 'FrontEnd\AuthUserController@addReview')->name('add_review');

// SEARCH product type
Route::post('shop/search/', 'FrontEnd\ShopController@searchProductTypes')->name('search_product_types');









/**
 * 
 * ADMIN USERS ROUTES
 * 
 * queste route si gestiscono tutte le chiamate delle varie risorse ref:
 * https://laravel.com/docs/master/controllers#resource-controllers
 */

Route::prefix('auth')->group(function () {

    /**
     * USER ROUTES
     */
    Route::get('/profile', 'FrontEnd\AuthUserController@getProfile')->name('profile');
    Route::post('/profile/edit', 'FrontEnd\AuthUserController@editProfile')->name('edit_profile');

    /**
     * MANAGEMENT ROUTES 
     */
    Route::group(['middleware' => ['can:manageProperties']], function () {
        Route::resources([
            'addresses' => 'AddressController', //Implemented         
            'attributes' => 'AttributeController',   //Implemented
            'carriers' => 'CarrierController',  //Implemented
            'creditCards' => 'CreditCardController',    //Implemented
            'deliveryStatuses' => 'DeliveryStatusController', //Implemented
            'invoices' => 'InvoiceController',      //Implemented
            'ivaCategories' => 'IvaCategoryController', //Implemented
            'nations' => 'NationController',    //Implemented
            'paymentMethods' => 'PaymentMethodController', //Implemented
            'producers' => 'ProducerController',    //Implemented
            'reviews' => 'ReviewController',
            'towns' => 'TownController',
            'users' => 'UserController',
            'values' => 'ValueController'
        ]);

        Route::get('/properties', 'FrontEnd\AdminDashboardController@getPropertiesManagement')->name('dashboard.properties');
        Route::get('/catalog', 'FrontEnd\AdminDashboardController@getCatalogManagement')->name('dashboard.catalog');
    });

    Route::group(['middleware' => ['can:manageAccounts']], function () {
        Route::resources([
            'users' => 'UserController',
        ]);
    });

    Route::group(['middleware' => ['can:manageOrders']], function () {
        Route::resources([
            'orders' => 'OrderController',  //Implemented
            'orderDetails' => 'OrderDetailController',  //Implemented
        ]);
    });

    Route::group(['middleware' => ['can:manageShipments']], function () {
        Route::resources([
            'shipments' => 'ShipmentController',   //Implemented
        ]);
    });

    Route::group(['middleware' => ['can:manageCategories']], function () {
        Route::resources([
            'categories' => 'CategoryController',   //Implemented
        ]);
    });

    Route::group(['middleware' => ['can:manageProducts']], function () {
        Route::resources([
            'products' => 'ProductController',  //Implemented
        ]);
    });

    Route::group(['middleware' => ['can:manageProductTypes']], function () {
        Route::resources([
            'productTypes' => 'ProductTypeController',  //Implemented
        ]);
    });

    Route::group(['middleware' => ['can:manageProductImages']], function () {
        Route::resources([
            'productImages' => 'ProductImageController', //Implemented
        ]);
    });






    Route::group(['middleware' => ['role:Administrator|Shipment Representative|Inventory Representative']], function () {
        Route::get('roles', 'FrontEnd\AdminDashboardController@manageRoles')->name('manageRoles');
        Route::get('home', 'FrontEnd\AdminDashboardController@index')->name('dashboard');
        Route::get('roles/edit/{id}', 'FrontEnd\AdminDashboardController@editUserRoles')->name('editUserRoles');
        Route::post('roles/edit/{id}', 'FrontEnd\AdminDashboardController@changeUserRoles'); // --> FOR AJAX CALL
        Route::post('products/{id}/images', 'ProductController@getImages')->name('getProductImages');
        Route::get('products/{id}/properties', 'ProductController@getProperties')->name('getProductProperties');
        Route::post('products/{id}/properties', 'ProductController@addValue')->name('addProperty');
        Route::delete('products/{id}/properties/{value}', 'ProductController@removeValue')->name('property.delete');
        Route::get('attributes/{id}/values', 'AttributeController@getValues')->name('getValuesByAttribute');
        Route::get('products/{id}/images', 'ProductController@redirectToProductImages')->name('redirectToProductImages');
        Route::get('users/edit/{id}', 'FrontEnd\AdminDashboardController@editUser')->name('editUser');

        /**
         * Design routes
         */
        Route::get('website/edit', 'FrontEnd\AdminDashboardController@getComponents')->name('components.index');
        Route::get('website/edit/{resource}', 'FrontEnd\AdminDashboardController@editResource')->name('components.edit');
        Route::post('website/edit/{resource}', 'FrontEnd\AdminDashboardController@updateResource')->name('components.update');
        Route::get('home/informations', 'FrontEnd\AdminDashboardController@getInformations')->name('website.informations');
        
    });
});
