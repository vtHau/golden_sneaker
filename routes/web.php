<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::post('delete-cart', 'HomeController@delete_cart');
Route::post('update-cart', 'HomeController@update_cart');
Route::post('add-cart', 'HomeController@add_cart');
