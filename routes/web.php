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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'center'], function (){
    $route = 'center';

    Route::get('/', 'CenterController@index')->name($route . '.index');
    Route::get('/create', 'CenterController@create')->name($route . '.create');
    Route::post('/create', 'CenterController@store')->name($route . '.store');
    Route::get('/update/{id}', 'CenterController@edit')->name($route . '.edit');
    Route::post('/update/{id}', 'CenterController@update')->name($route . '.update');
    Route::get('/delete/{id}', 'CenterController@delete')->name($route . '.delete');
});
