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

Route::prefix('api')->group(function() {
    Route::resource('notes', 'NotesController');

    Route::put('/notes/{note}/toggleFavourite', 'NotesController@toggleFavourite');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/user', function () {
    return view('user.index');
});

Route::get('new-back-note', function() {
   return view('note.index');
});

Route::get('/playground', 'NotesController@playground');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
