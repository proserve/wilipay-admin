<?php

use App\DataTables\CustomersDataTable;
use App\DataTables\UsersDataTable;

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/transactions/{user_id}', 'TransactionsController@getByUser')->name('transactionsByUser');
    Route::get('/customers', function (CustomersDataTable $dataTable) {
        return $dataTable->render('users.users', ['title' => 'Customers List']);
    })->name('users');
    Route::get('/adminUsers', function (UsersDataTable $dataTable) {
        return $dataTable->render('users.admin', ['title' => 'admin users']);
    })->name('adminUsers');
});

