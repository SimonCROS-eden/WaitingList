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
Route::get('/connect', 'TicketController@connect')->name('connect');
Route::put('/ticket/{ticket}/take', 'TicketController@updateTake')->name('updateTake');
Route::post('/ticket/{ticket}/end', 'TicketController@deleteEnd')->name('deleteEnd');
Route::post('/ticket/{ticket}/renew', 'TicketController@renewTicket')->name('renewTicket');
Route::resource('ticket', 'TicketController')->except(['index'])->middleware('auth');
Route::resource('tag', 'TagController')->except(['edit', 'create', 'show'])->middleware('admin');
