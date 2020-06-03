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

//Routes Guests
Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeController@index')->where(['id' => '[0-9]+'])->name('product');
Route::get('/product/category/{category}', 'HomeController@index')->where(['category' => '[aA-zZ]+'])->name('category');

//Routes admin
Route::resource('products', 'ProductController')->middleware('auth');
Route::resource('categories', 'CategoryController')->middleware('auth');