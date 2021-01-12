<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Admins;

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

Route::group(['prefix'=>'useraction'],function(){
    Route::post('login', 'Api\LoginRegisterController@login');
    Route::post('register','Api\LoginRegisterController@register');
    Route::middleware('auth:api')->group(function () {

        Route::group(['prefix'=>'user'],function(){
            Route::resource('userdata', 'Api\User\UserDataController');
            Route::get('get_cards', 'Api\User\UserDataController@get_cards');
            Route::get('pininfo', 'Api\User\UserDataController@pininfo');
            Route::resource('payings', 'Api\User\PayingDataController');
            Route::resource('paying-products', 'Api\User\PayingProductDataController');
        });

        Route::group(['prefix' => 'pwabout'], function () {
            Route::get('termofuse','Api\PwAbout\PWAboutController@termofuse');
            Route::get('settings','Api\PwAbout\PWAboutController@settings');
            Route::get('about','Api\PwAbout\PWAboutController@about');
            Route::get('faqs','Api\PwAbout\PWAboutController@faqs');
            Route::get('teams','Api\PwAbout\PWAboutController@teams');
            Route::get('whychooseus','Api\PwAbout\PWAboutController@whychooseus');
        });

        Route::group(['prefix' => 'customers'], function () {
            Route::resource('customers','Api\Customers\CustomersController');
            Route::resource('campaigns','Api\Customers\CampaignsController');
            Route::resource('locations','Api\Customers\LocationsController');
            Route::resource('comments','Api\Customers\CommentsController');
            Route::resource('ratings','Api\Customers\RatingsController');
        });

        Route::post('contactus','Api\Action\ActionController@contactus');
    });
});

Route::get('adminregister', function () {
    try {
        $user = Admins::create([
            'profilePhoto' => Str::random(11).'png',
            'role' => 3,
            'customer_id' => 1,
            'name' => Str::random(11),
            'email' => Str::random(11) . '@mail.com',
            'password' => Hash::make('12345678'),
        ]);
        return response()->json($user);
    } catch (\Exception $e) {
        return $e;
    }
});






