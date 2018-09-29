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
Route::get('/', 'HomeController@index');
Route::post('/checkKata', 'HomeController@check');
Route::get('/doc', 'HomeController@doc');
Route::post('/checkDoc', 'HomeController@checkdoc');