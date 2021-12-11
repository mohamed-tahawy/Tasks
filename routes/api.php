<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\PassportAuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user register and login api 
Route::post('register', 'App\Http\Controllers\ApiController@register');
Route::post('login', 'App\Http\Controllers\ApiController@login');


// get all products with
// get all products with

 // prevent any user to access this route without login
Route::middleware('auth:api')->group(function () {
        // return Product::with('varians', 'productOption')->get();
        //get all product and product detail
        Route::get('/products', 'App\Http\Controllers\ApiController@getProducts');
        Route::get('/product/{id}', 'App\Http\Controllers\ApiController@getProduct');
        Route::post('logout', 'App\Http\Controllers\ApiController@logout');


});
