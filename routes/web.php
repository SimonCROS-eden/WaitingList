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

Auth::routes();

var_dump(Auth::check());

if (Auth::check()) {
    Route::ressource('/', 'TicketController@index')->name('dashboard');
} else {
    Route::get('/', 'HomeController@index')->name('home');
}




Route::get('/test', 'TestController@index')->name('test');
