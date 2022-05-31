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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('promo', 'Api\PromoController@index');
Route::get('promo/{kode_promo}', 'Api\PromoController@show');
Route::put('promo/{kode_promo}', 'Api\PromoController@update');

Route::get('transaksi', 'Api\TransaksiController@index');
Route::get('transaksi/{id}', 'Api\TransaksiController@show');

Route::get('driver', 'Api\DriverController@index');
Route::put('driver/{id}', 'Api\DriverController@update');

// Route::get('topDriver', 'Api\TransaksiController@topDriver');
Route::post('rating', 'Api\RatingController@store');
Route::get('rating', 'Api\RatingController@index');

Route::post('nota', 'Api\NotaController@store');
Route::get('nota', 'Api\NotaController@index');