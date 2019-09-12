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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource ('Conductor','ConductorController');

Route::resource('Ruta','RutaController');

Route::resource('Tipo_Punto', 'Tipo_PuntoController');

Route::resource('Punto_Ruta', 'Punto_RutaController');

Route::resource('Punto', 'PuntoController');