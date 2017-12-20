<?php

Route::group(['middleware' => 'web', 'prefix' => 'core', 'namespace' => 'Modules\Core\Http\Controllers'], function()
{
    Route::get('/', 'CoreController@index');
    Route::post('/uploadrecording', 'CoreController@uploadRecording');
    Route::post('/getlink', 'CoreController@getLink');
    Route::post('/deletefile', 'CoreController@deleteFile');
});
