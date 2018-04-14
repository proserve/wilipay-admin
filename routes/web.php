<?php


Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/users', 'CustomersController@index')->name('users');
    Route::get('/transactions/{user_id}', 'TransactionsController@getByUser')->name('transactionsByUser');
});

