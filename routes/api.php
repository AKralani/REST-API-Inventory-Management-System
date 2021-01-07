<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('stocks', 'ApiController@getAllStocks');
Route::get('stocks/{id}', 'ApiController@getStock');
Route::post('stocks', 'ApiController@createStock');
Route::put('stocks/{id}', 'ApiController@updateStock');
Route::delete('stocks/{id}', 'ApiController@deleteProduct');

Route::get('products', 'ApiController@getAllProducts');
Route::get('products/{id}', 'ApiController@geProductk');
Route::post('products', 'ApiController@createProduct');
Route::put('products/{id}', 'ApiController@updateProduct');
Route::delete('products/{id}', 'ApiController@deleteProduct');

Route::get('sales', 'ApiController@getAllSales');
Route::get('sales/{id}', 'ApiController@getSale');
Route::post('sales', 'ApiController@createSale');
Route::put('sales/{id}', 'ApiController@updateSale');
Route::delete('sales/{id}', 'ApiController@deleteSale');