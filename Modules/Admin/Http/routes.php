<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index');
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::post('/login', 'AdminController@login');
    Route::post('/ListJson', 'AdminController@ListJson');
    Route::post('/allow', 'AdminController@Allow');
    Route::post('/deny', 'AdminController@Deny');
    Route::get('/logout', 'AdminController@logout');
});
