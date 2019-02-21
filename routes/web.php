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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'twdemoController@index');
Route::post('/tweet', 'twdemoController@tweet');
Route::get('/users', 'UserController@index')->name('user_list');
Route::post('/users/follow/{follow_id}', 'UserController@follow');
Route::post('/users/follow/{follow_id}/delete', 'UserController@destroy');
//中括弧でid指定
