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

Route::get('/', 'ProductController@products');
Route::get('/upload_file' ,'UploadController@getForm', function (){})->middleware('auth');
Route::post('/upload_file' ,'UploadController@upload', function (){})->middleware('auth')->name('upload_file');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
