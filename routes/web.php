<?php


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
    Route::get('logs/me', 'LogController@me')->name('logs.me');
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'permission:' . config('permission.defaults.manage_users')], function () {
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::get('/logs', 'LogController@index')->name('logs');
    });

    Route::group(['middleware' => 'permission:' . config('permission.defaults.view_data')], function () {
        Route::get('/customers', 'CustomerController@index')->name('customers.index');
        Route::get('/customers/{id}', 'CustomerController@show')->name('customers.show');
        Route::get('/cards', 'CardController@index')->name('cards.index');
        Route::get('/cards/{customerId}', 'CardController@byCustomerId')->name('cards.byCustomerId');
        Route::get('/transactions', 'TransactionController@index')->name('transactions.index');
        Route::get('/transactions/{customerId}', 'TransactionController@byCustomerId')->name('transactions.byCustomerId');
    });

    Route::group(['middleware' => 'permission:' . config('permission.defaults.edit_data')], function () {
        Route::post('/customers/{id}/blocked', 'CustomerController@updateBlocked')->name('updateBlocked');
        Route::post('/customers/{id}/verified', 'CustomerController@updateVerified')->name('updateVerified');
    });

    Route::group(['middleware' => 'permission:' . config('permission.defaults.view_dashboard')], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/user/count/day', 'ChartController@usersPerDay')->name('usersPerDay');
    });

});


