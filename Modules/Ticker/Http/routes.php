<?php

Route::group(['middleware' => 'web', 'prefix' => 'ticker', 'namespace' => 'Modules\Ticker\Http\Controllers'], function()
{
    Route::get('/', 'TickerController@index');
});
