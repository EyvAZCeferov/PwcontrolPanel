<?php

Route::group(['middleware' => 'auth'], function () {
    Route::livewire('/', 'dashboard')->name('dashboard')->middleware(\App\Http\Middleware\Roles\BucketViewerController::class);
    Route::livewire('/profile/{id}', 'profile')->name('profile');
    Route::get('/logout', 'BaseController@logout')->name('logOut');
    Route::group(['prefix' => 'pwusers', 'middleware' => \App\Http\Middleware\Roles\TopAdminController::class], function () {
        Route::livewire('/', 'pwusers')->name('pwusers')->middleware(\App\Http\Middleware\Roles\DeletedController::class);
        Route::livewire('/{id}', 'pwuserinfo')->name('pwuserinfo');
        Route::livewire('/pinInfo/{id}', 'pininfo')->name('pwuser.pinInfo');
        Route::livewire('/browse{id}', 'browse-location')->name('browseLocation');
        Route::livewire('/{userid}/checkpayment/{checkid}', 'checkpayment')->name('checkpayment');
    });
    Route::group(['prefix' => 'locations', 'middleware' => \App\Http\Middleware\Roles\BucketViewerController::class], function () {
        Route::livewire('/', 'locations')->name('locations')->middleware(\App\Http\Middleware\Roles\DeletedController::class);
        Route::livewire('/add', 'edt-add-location')->name('addLocation');
        Route::livewire('/edit/{id}', 'edt-add-location')->name('editLocation');
        Route::livewire('/browse{id}', 'browse-location')->name('browseLocation');
    });
    Route::group(['prefix' => 'customers', 'middleware' => \App\Http\Middleware\Roles\TopAdminController::class], function () {
        Route::livewire('/', 'customers')->name('customers')->middleware(\App\Http\Middleware\Roles\DeletedController::class);
        Route::livewire('/add', 'edit-add-customers')->name('addCustomers');
        Route::livewire('/edit/{id}', 'edit-add-customers')->name('editCustomers');
    });
    Route::group(['prefix' => 'admins', 'middleware' => \App\Http\Middleware\Roles\TopAdminController::class], function () {
        Route::livewire('/', 'admins')->name('admins')->middleware(\App\Http\Middleware\Roles\DeletedController::class);
        Route::livewire('/add', 'admin-add-edit')->name('addAdmin');
        Route::livewire('/edit/{id}', 'admin-add-edit')->name('editAdmin');
    });
    Route::group(['prefix' => 'categories', 'middleware' => \App\Http\Middleware\Roles\BucketViewerController::class], function () {
        Route::livewire('/', 'categories')->name('categories')->middleware(\App\Http\Middleware\Roles\DeletedController::class);
        Route::livewire('/add', 'categories-add-edit')->name('addCategories');
        Route::livewire('/edit/{id}', 'categories-add-edit')->name('editCategories');
    });
    Route::group(['prefix' => 'posts', 'middleware' => \App\Http\Middleware\Roles\BucketViewerController::class], function () {
        Route::livewire('/', 'posts')->name('posts')->middleware(\App\Http\Middleware\Roles\DeletedController::class);
        Route::livewire('/add', 'posts-edit-add')->name('postsAdd');
        Route::livewire('/edit/{id}', 'posts-edit-add')->name('postsEdit');
        Route::livewire('/browse/{id}', 'posts-browse')->name('postsBrowse');
    });
    Route::group(['prefix' => 'locale'], function () {
        Route::get('/{locale}', 'BaseController@changeLocale')->name('locale')->middleware('App\Http\Middleware\Localization');
    });
    Route::group(['prefix' => 'buckets'], function () {
        Route::livewire('/', 'bockets')->name('buckets');
        Route::livewire('/browse/{id}', 'buckets-browse')->name('bucketsBrowse');
    });
    Route::group(['prefix' => 'project', 'middleware' => \App\Http\Middleware\Roles\TopAdminController::class], function () {
        Route::livewire('/settings', 'setting')->name('settings');
        Route::livewire('/about', 'about')->name('about');
        Route::livewire('/FaqsAndTermofuse', 'faqsandtermofuse')->name('faqsandtermofuse');
    });
    Route::group(['prefix' => 'order'], function () {
        Route::get('/whychoseusorder', 'BaseController@changeWHYCHOOSEOrder')->name('whychoseusorder');
        Route::get('/teammemberorder', 'BaseController@changeTEAMMEMBEROrder')->name('teammemberorder');
        Route::get('/faqsorder', 'BaseController@changeFAQSOrder')->name('faqsorder');
    });
});
Route::group(['prefix' => '/'], function () {
    Route::get('login', 'BaseController@login')->name('login')->middleware('guest');
    Route::post('loginPost', 'BaseController@loginAcc')->name('loginPost');
});
Route::fallback('BaseController@fallback');

