<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'permission:' . config('permission.defaults.manage_users')], function () {
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::get('/logs', 'LogController@index')->name('logs');
    });

    Route::group(['middleware' => 'permission:' . config('permission.defaults.view_data')], function () {
        Route::get('/transactions/{user_id}', 'TransactionController@getByUser')->name('transactionsByUser');
        Route::get('/customers', 'CustomerController@index')->name('customers.index');
    });

    Route::group(['middleware' => 'permission:' . config('permission.defaults.view_dashboard')], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    });

});


