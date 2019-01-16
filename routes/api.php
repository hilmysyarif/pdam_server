<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
  Route::post('details', 'API\UserController@details');
  Route::post('myhistories', 'API\HistoriesController@index');
  Route::post('current', 'API\HistoriesController@current');
  Route::post('total_used', 'API\HistoriesController@last_total_used');
  Route::post('add_new', 'API\HistoriesController@add_new');
});
