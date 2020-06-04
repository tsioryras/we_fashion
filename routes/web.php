<?php

use Illuminate\Support\Facades\Auth;
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

//Routes Guests
Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeController@show')->where(['id' => '[0-9]+'])->name('product');
Route::get('/product/code/{code}', 'HomeController@byCode')->where(['code' => '[aA-zZ]+'])->name('product_code');
Route::get('/product/category/{category}', 'HomeController@byCategory')->where(['category' => '[aA-zZ]+'])->name('category');


//Routes admin
Auth::routes();
Route::resource('products', 'ProductController')->middleware('auth');
Route::resource('categories', 'CategoryController')->middleware('auth');
Route::get('/admin', 'DashboardController@index')->middleware('auth');
