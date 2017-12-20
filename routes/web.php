
<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/','\Modules\Home\Http\Controllers\HomeController@index');
Route::get('/index2','\Modules\Ticker\Http\Controllers\TickerController@index');
Route::get('/','\Modules\Core\Http\Controllers\CoreController@index');
