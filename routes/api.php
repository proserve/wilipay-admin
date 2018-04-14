<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->prefix('v1')->group(function () {
    Route::get('/users', 'UsersController@list');
});

