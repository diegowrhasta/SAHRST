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
    Route::post('Punto_Ruta', 'Punto_RutaController@store');
    Route::get('Punto_Ruta', 'Punto_RutaController@index');
    Route::post('Punto', 'PuntoController@store');
    Route::get('Punto', 'PuntoController@index');
    Route::post('Conductor/{Conductor}/profile_pic', 'ConductorController@update_avatar');
    Route::get('Conductor/{Conductor}/profile_pic', 'ConductorController@get_avatar');
    Route::get('Conductor/{Conductor}/get_route', 'ConductorController@retrieveRoute');
    Route::get('Vehiculo/{Vehiculo}', 'VehiculoController@show');
    Route::get('Vehiculo', 'VehiculoController@index');
    Route::post('Vehiculo', 'VehiculoController@store');
    Route::delete('Vehiculo/{Vehiculo}', 'VehiculoController@destroy');
    Route::put('Vehiculo/{Vehiculo}', 'VehiculoController@update');
    Route::get('Conductor/{Conductor}/Vehiculo', 'ConductorController@getVehiculos');
    Route::get('Conductor/{Conductor}/Vehiculo/{Vehiculo}', 'ConductorController@getVehiculo');
    Route::post('Conductor_Vehiculo', 'Conductor_VehiculoController@store');
    Route::get('Conductor/{Conductor}/Punto_Control','ConductorController@getPuntoControl');
    Route::post('Conductor/{Conductor}/isInCheckpoint', 'ConductorController@goodPuntoControl');
    Route::post('Conductor/{Conductor}/Reportar','ConductorController@badPuntoControl');
    Route::post('Round_Robinr/start','Round_RobinrController@startRoundRobin');
});

