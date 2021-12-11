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

Route::get('/', function () {
    return view('welcome');
});
Route::get('output', 'App\Http\Controllers\TaskController@task');
Route::get('dashboard/create-product', 'App\Http\Controllers\TaskController@createProduct');
Route::post('dashboard/create-product', 'App\Http\Controllers\TaskController@storeProduct');

// data table product
Route::get('dashboard/product', 'App\Http\Controllers\TaskController@product');
Route::get('dashboard/product/all', 'App\Http\Controllers\TaskController@getProducts');
Route::get('dashboard/product/delete/{id}', 'App\Http\Controllers\TaskController@delete');
Route::get('dashboard/edit/product/{id}', 'App\Http\Controllers\TaskController@edit');
Route::put('dashboard/edit/product/{id}', 'App\Http\Controllers\TaskController@update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
