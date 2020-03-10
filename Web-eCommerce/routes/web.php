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

Route::get('/products/{id}', 'FrontEnd\ProductDetailController@show')->name('product_detail');

Route::get('template', function () {
    return view('layouts/layout');
});

Route::get('admin', function () {
    return view('backoffice.pages.home');
});

