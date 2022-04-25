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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');

});

Route::get('clients', 'App\Http\Controllers\ClientsController@index'); //listar clientes
Route::delete('clients/{id}', 'App\Http\Controllers\ClientsController@delete'); //eliminar clientes
Route::post('clients-store', 'App\Http\Controllers\ClientsController@store'); //crear clientes
Route::get('clients-edit/{id}', 'App\Http\Controllers\ClientsController@edit'); //listar clientes
Route::put('clients-update/{id}', 'App\Http\Controllers\ClientsController@update'); //editrar clientes

Route::get('vendors', 'App\Http\Controllers\VendorsController@index'); //listar vendedores
Route::delete('vendors/{id}', 'App\Http\Controllers\VendorsController@delete'); //eliminar vendedores
Route::post('vendors-store', 'App\Http\Controllers\VendorsController@store'); //crear vendedores
Route::get('vendors-edit/{id}', 'App\Http\Controllers\VendorsController@edit'); //listar vendedores
Route::put('vendors-update/{id}', 'App\Http\Controllers\VendorsController@update'); //editrar vendedores

Route::get('products', 'App\Http\Controllers\ProductsController@index'); //listar productos
Route::delete('products/{id}', 'App\Http\Controllers\ProductsController@delete'); //eliminar productos
Route::post('products-store', 'App\Http\Controllers\ProductsController@store'); //crear productos
Route::get('products-edit/{id}', 'App\Http\Controllers\ProductsController@edit'); //listar productos
Route::put('products-update/{id}', 'App\Http\Controllers\ProductsController@update'); //editrar productos

Route::get('bills', 'App\Http\Controllers\BillsController@index'); //listar facturas
Route::delete('bills/{id}', 'App\Http\Controllers\BillsController@delete'); //eliminar facturas
Route::post('bills-store', 'App\Http\Controllers\BillsController@store'); //crear facturas
Route::get('bills-edit/{id}', 'App\Http\Controllers\BillsController@edit'); //listar facturas
Route::put('bills-update/{id}', 'App\Http\Controllers\BillsController@update'); //editrar facturas

Route::delete('bills-products/{id}', 'App\Http\Controllers\BillProductsController@delete'); //eliminar factura-producto
Route::post('bills-products-store', 'App\Http\Controllers\BillProductsController@store'); //crear factura-producto
Route::get('bills-products-get/{id}', 'App\Http\Controllers\BillProductsController@getBuysByID'); //listar facturas
