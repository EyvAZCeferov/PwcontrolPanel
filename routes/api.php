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

Route::group(['prefix' => 'media'], function () {
    Route::get('customers', 'Api\ApiController@customers');
    Route::get('customers/{id}', 'Api\ApiController@customer');
    Route::get('categories', 'Api\ApiController@categories');
    Route::get('categories/{id}', 'Api\ApiController@category');
    Route::get('posts', 'Api\ApiController@posts');
    Route::get('posts/{id}', 'Api\ApiController@post');
    Route::get('posts/{id}/read/{bool}', 'Api\ApiController@postread')->middleware(\App\Http\Middleware\ApiUserController::class);
    Route::get('locations', 'Api\ApiController@locations');
    Route::get('locations/{id}', 'Api\ApiController@location');
});
