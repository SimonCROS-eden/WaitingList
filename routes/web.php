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

Route::get('/', 'TicketController@index')->name('dashboard');
Route::post('/data', 'TicketController@data');
Route::resource('ticket', 'TicketController')->except(['index'])->middleware('auth');
