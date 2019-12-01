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

Route::get('/', 'ProductController@products')->name('welcome');
Route::get('/upload_file' ,'UploadController@getForm')->middleware('auth');
Route::post('/upload_file' ,'UploadController@upload')->middleware('auth')->name('upload_file');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/AddToCart', 'ProductController@AddToCart')->name('AddToCart');
Route::post('/AddToCort', 'ProductController@AddToCort')->name('AddToCort');
Route::get('/products/{id}', 'ProductController@productsite')->name('product');
Route::get('/checkout', 'ProductController@checkout')->name('checkout');

Route::get('/shopping-cort', 'ProductController@getCort')->name('shopping-cort');
