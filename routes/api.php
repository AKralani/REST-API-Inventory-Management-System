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
//Route::post('stocks', 'ApiController@createStock');
Route::put('stocks/{id}', 'ApiController@updateStock');
Route::delete('stocks/{id}', 'ApiController@deleteStock');

//Route::get('stocks', 'ApiController@getAllStocks');
//Route::get('stocks/{id}', 'ApiController@stockByID');
Route::post('stocks', 'ApiController@stockSave');
//Route::put('stocks/{id}', 'ApiController@stockUpdate');
//Route::delete('stocks/{id}', 'ApiController@stockDelete');


Route::get('products', 'ApiController@getAllProducts');
Route::get('products/{id}', 'ApiController@geProductk');
//Route::post('products', 'ApiController@createProduct');
Route::post('products', 'ApiController@productSave');
Route::put('products/{id}', 'ApiController@updateProduct');
Route::delete('products/{id}', 'ApiController@deleteProduct');


Route::get('sales', 'ApiController@getAllSales');
Route::get('sales/{id}', 'ApiController@getSale');
//Route::post('sales', 'ApiController@createSale');
Route::post('sales', 'ApiController@saleSave');
Route::put('sales/{id}', 'ApiController@updateSale');
Route::delete('sales/{id}', 'ApiController@deleteSale');