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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return redirect(\route("films.index"));
});

Route::get('/films', "Frontend\FilmController@index")->name("films.index");
Route::get('/films/create', "Frontend\FilmController@create")->name("films.create");
Route::get('/films/{name}', 'Frontend\FilmController@show')->name('film.show');
