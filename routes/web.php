<?php

use App\DataTables\CustomersDataTable;

Auth::routes();

Route::group(['middleware' => ['auth', 'permission:manage users']], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
});

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/transactions/{user_id}', 'TransactionsController@getByUser')->name('transactionsByUser');
    Route::get('/customers', function (CustomersDataTable $dataTable) {
        return $dataTable->render('customers.index', ['title' => 'Customers List']);
    })->name('customers');
});

