<?php

use Illuminate\Support\Facades\Route;

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
//登录
Route::prefix('/login')->group(function(){
	Route::get('login','Login\LoginController@login');
	Route::post('logindo','Login\LoginController@logindo');
});
Route::prefix('/xin')->middleware('islogin')->group(function(){
	Route::get('index','Xin\XinController@index');
	Route::get('create','Xin\XinController@create');
	Route::post('store','Xin\XinController@store');
	Route::get('ajax','Xin\XinController@ajax');
	Route::get('ajaxs','Xin\XinController@ajaxs');
	Route::get('destroy/{id}','Xin\XinController@destroy');
	Route::get('edit/{id}','Xin\XinController@edit');
	Route::post('update/{id}','Xin\XinController@update');
});