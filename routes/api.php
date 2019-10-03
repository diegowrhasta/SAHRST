<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::resource ('Conductor','ConductorController');
    Route::resource('Ruta','RutaController');
    Route::resource('Tipo_Punto', 'Tipo_PuntoController');
    Route::resource('Punto_Ruta', 'Punto_RutaController');
    Route::resource('Punto', 'PuntoController');
    Route::post('Conductor/{Conductor}/profile_pic', 'ConductorController@update_avatar');
    Route::get('Conductor/{Conductor}/profile_pic', 'ConductorController@get_avatar');
    Route::get('Conductor/{Conductor}/get_route', 'ConductorController@retrieveRoute');
});

