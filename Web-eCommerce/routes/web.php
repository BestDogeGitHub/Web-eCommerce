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

Route::get('/', function () {
    return view('frontoffice.pages.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*  OLD FUNCTION
Route::get('/product/{id}', function ($id) {
    return view('pages.product_details', ['id' => $id]);
});
*/
Route::get('products/{type}', 'FrontEnd\ShopController@getProductsFromType')->name('products');
Route::get('products/details/{id}', 'FrontEnd\ProductDetailController@show')->name('product_detail');
Route::get('shop/categories', 'FrontEnd\ShopController@getCategoriesView')->name('categories')->defaults('parent', 0);
Route::get('shop/categories/{parent}', 'FrontEnd\ShopController@getCategoriesView')->name('categories_par');
Route::get('shop', 'FrontEnd\ShopController@index')->name('shop');
Route::get('shop/{category}', 'FrontEnd\ShopController@getCatalogoCategory')->name('products_category');

Route::get('admin', function () {
    return view('backoffice.pages.home');
});

Route::get('auth/roles', 'FrontEnd\AdminDashboardController@manageRoles')->name('manageRoles');
Route::get('auth/roles/edit/{id}', 'FrontEnd\AdminDashboardController@editUserRoles')->name('editUserRoles');
Route::post('auth/roles/edit/{id}', 'FrontEnd\AdminDashboardController@changeUserRoles');
Route::get('auth/users/edit/{id}', 'FrontEnd\AdminDashboardController@editUser')->name('editUser');
Route::get('auth/products', 'ProductController@index');
Route::post('auth/products', 'ProductController@store')->name('products.store');
Route::delete('auth/products/{id}', 'ProductController@destroy')->name('products.store');