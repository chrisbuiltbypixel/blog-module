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

Route::group(['middleware' => 'auth:admin_api'], function () {
    Route::get('blogs', 'Api\BlogController@index');
    Route::get('blogs/{blog}', 'Api\BlogController@show');
    Route::post('blogs', 'Api\BlogController@store');
    Route::put('blogs/{blog}', 'Api\BlogController@update');
    Route::delete('blogs', 'Api\BlogController@destroy');
});
