<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\User;

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
Route::get('register', function () {
    try {
        $user = User::create([
            'profilePhoto' => Str::random(11),
            'role' => 3,
            'customer_id' => 1,
            'name' => Str::random(11),
            'email' => Str::random(11) . '@mail.com',
            'password' => Hash::make('12345678'),
        ]);
        return $user;
    } catch (\Exception $e) {
        return $e;
    }
});






