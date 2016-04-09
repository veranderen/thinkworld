<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/china', 'HomeController@china');
Route::get('/hk', 'HomeController@hk');
Route::get('/data/save', 'DataController@save');
Route::get('/data/sse50Save', 'DataController@sse50Save');
Route::get('/data/hsi_save', 'DataController@hsiSave');
Route::get('/data/fileDownload', 'DataCollectionController@fileDownload');
Route::get('/test', 'HomeController@test');



