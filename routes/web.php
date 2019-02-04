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
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['studentMW']], function () {
        Route::get('/submit','HomeController@submit');
        Route::get('/method','StudentController@index');
        Route::any('/data','StudentController@store1');
    });

    Route::group(['middleware' => ['aluminiMW']], function () {
        Route::get('/alumnisumit', 'AlumniController@update');
    });
    Route::get('/schedule','AlumniController@index');

});
Route::get('/test','StudentController@userData');



