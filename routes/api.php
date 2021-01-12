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

Route::get('stocks', 'StockController@getAllStocks');
Route::get('stocks/{id}', 'StockController@getStock');
//Route::post('stocks', 'StockController@createStock');
Route::put('stocks/{id}', 'StockController@updateStock');
Route::delete('stocks/{id}', 'StockController@deleteStock');

//Route::get('stocks', 'StockController@getAllStocks');
//Route::get('stocks/{id}', 'StockController@stockByID');
Route::post('stocks', 'StockController@stockSave');
//Route::put('stocks/{id}', 'StockController@stockUpdate');
//Route::delete('stocks/{id}', 'StockController@stockDelete');


Route::get('products', 'ProductController@getAllProducts');
Route::get('products/{id}', 'ProductController@getProduct');
//Route::post('products', 'ProductController@createProduct');
Route::post('products', 'ProductController@productSave');
Route::put('products/{id}', 'ProductController@updateProduct');
Route::delete('products/{id}', 'ProductController@deleteProduct');


Route::get('sales', 'SaleController@getAllSales');
Route::get('sales/{id}', 'SaleController@getSale');
//Route::post('sales', 'SaleController@createSale');
Route::post('sales', 'SaleController@saleSave');
Route::put('sales/{id}', 'SaleController@updateSale');
Route::delete('sales/{id}', 'SaleController@deleteSale');