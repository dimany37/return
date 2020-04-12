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
Route::post('/edit' ,'UploadController@edit')->middleware('auth')->name('edit');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/AddToCort', 'ProductController@AddToCort')->name('AddToCort');
Route::get('/products/{id}', 'ProductController@productsite')->name('product');
Route::get('/category/{id}', 'ProductController@categorysite')->name('category');
Route::get('/checkout', 'ProductController@checkout')->name('checkout');
Route::post('/payment', 'PaymentController@pay');

Route::get('/payment', 'PaymentController@pay')->name('pay');

Route::get('/shopping-cart', 'ProductController@shoppingCart')->name('shopping-cart');

Route::post('/shopping-cart', 'ProductController@delete')->name('delete');
Route::post('/checkout', 'ProductController@checkout')->name('checkout');


Route::get('/upload_news' ,'UploadController@getNews')->middleware('auth')->name('getNews');
Route::post('/upload_news' ,'UploadController@uploadNews')->middleware('auth')->name('uploadNews');

Route::get('/tabel' ,'UploadController@getTabel')->middleware('auth')->name('getTabel');
Route::post('/tabel' ,'UploadController@uploadTabel')->middleware('auth')->name('uploadTabel');
