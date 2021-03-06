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

Route::post('/lang', function (\Illuminate\Http\Request $request){
    session(['lang' => $request->get('lang')]);
    return redirect()->route('home');
})->name('lang');

Route::group(['prefix' => 'center'], function (){
    $route = 'center';

    Route::get('/', 'CenterController@index')->name($route . '.index');
    Route::get('/create', 'CenterController@create')->name($route . '.create');
    Route::post('/create', 'CenterController@store')->name($route . '.store');
    Route::get('/update/{id}', 'CenterController@edit')->name($route . '.edit');
    Route::post('/update/{id}', 'CenterController@update')->name($route . '.update');
    Route::get('/delete/{id}', 'CenterController@delete')->name($route . '.delete');
});

Route::group(['prefix' => 'building'], function (){
    $route = 'building';

    Route::get('/', 'BuildingController@index')->name($route . '.index');
    Route::get('/create', 'BuildingController@create')->name($route . '.create');
    Route::post('/create', 'BuildingController@store')->name($route . '.store');
    Route::get('/update/{id}', 'BuildingController@edit')->name($route . '.edit');
    Route::post('/update/{id}', 'BuildingController@update')->name($route . '.update');
    Route::get('/delete/{id}', 'BuildingController@delete')->name($route . '.delete');
});
