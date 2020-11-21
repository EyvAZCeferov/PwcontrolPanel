<?php

Route::group(['middleware' => 'auth'], function () {
    Route::livewire('/', 'dashboard')->name('dashboard');
    Route::livewire('/profile/{id}', 'profile')->name('profile');
    Route::get('/logout', 'BaseController@logout')->name('logOut');
    Route::group(['prefix' => 'pwusers'], function () {
        Route::livewire('/', 'pwusers')->name('pwusers');
        Route::livewire('/{id}', 'pwuserinfo')->name('pwuserinfo');
        Route::livewire('/pinInfo/{id}', 'pininfo')->name('pwuser.pinInfo');
        Route::livewire('/browse{id}', 'browse-location')->name('browseLocation');
        Route::livewire('/{userid}/checkpayment/{checkid}', 'checkpayment')->name('checkpayment');
    });
    Route::group(['prefix' => 'locations'], function () {
        Route::livewire('/', 'locations')->name('locations');
        Route::livewire('/add', 'edt-add-location')->name('addLocation');
        Route::livewire('/edit/{id}', 'edt-add-location')->name('editLocation');
        Route::livewire('/browse{id}', 'browse-location')->name('browseLocation');
    });
    Route::group(['prefix' => 'customers'], function () {
        Route::livewire('/', 'customers')->name('customers');
        Route::livewire('/add', 'edit-add-customers')->name('addCustomers');
        Route::livewire('/edit/{id}', 'edit-add-customers')->name('editCustomers');
    });
    Route::group(['prefix' => 'admins'], function () {
        Route::livewire('/', 'admins')->name('admins');
        Route::livewire('/add', 'admin-add-edit')->name('addAdmin');
        Route::livewire('/edit/{id}', 'admin-add-edit')->name('editAdmin');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::livewire('/', 'categories')->name('categories');
        Route::livewire('/add', 'categories-add-edit')->name('addCategories');
        Route::livewire('/edit/{id}', 'categories-add-edit')->name('editCategories');
    });
    Route::group(['prefix' => 'posts'], function () {
        Route::livewire('/', 'posts')->name('posts');
        Route::livewire('/add', 'posts-edit-add')->name('postsAdd');
        Route::livewire('/edit/{id}', 'posts-edit-add')->name('postsEdit');
        Route::livewire('/calendar', 'posts-calendar')->name('postsCalendar');
        Route::livewire('/browse/{id}', 'posts-browse')->name('postsBrowse');
    });
});
Route::group(['middleware' => 'web', 'prefix' => '/'], function () {
    Route::get('login', 'BaseController@login');
    Route::post('login', 'BaseController@loginAcc')->name('login');
});

