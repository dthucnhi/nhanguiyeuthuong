<?php

Route::group(['middleware' => 'web', 'prefix' => 'home', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
    Route::get('/', 'HomeController@index');
    Route::post('/saveinfo', 'HomeController@saveinfo');
    Route::get('/updateiscall/{id}', 'HomeController@updateIsCall');
});
