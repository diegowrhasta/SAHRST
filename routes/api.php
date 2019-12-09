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
    Route::resource('Tipo_Punto', 'Tipo_PuntoController');
    Route::resource('Ruta','RutaController');
    Route::post('Ruta', 'RutaController@store');
    Route::get('Ruta', 'RutaController@index');
    Route::get('Ruta/{ruta_id}', 'RutaController@show');
    Route::put('Ruta/{ruta_id}','RutaController@update');
    Route::delete('Ruta/{ruta_id}','RutaController@destroy');
    Route::get('Ruta/{ruta_id}/getPuntos','RutaController@getPuntos');
    Route::post('Punto_Ruta', 'Punto_RutaController@store');
    Route::get('Punto_Ruta', 'Punto_RutaController@index');
    Route::delete('Punto_Ruta/{punto_ruta_id}', 'Punto_RutaController@destroy');
    Route::post('Punto', 'PuntoController@store');
    Route::get('Punto', 'PuntoController@index');
    Route::get('Punto/{punto_id}','PuntoController@show');
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
    Route::get('Conductor_Vehiculo', 'Conductor_VehiculoController@index');
    Route::get('Conductor/{Conductor}/Punto_Control','ConductorController@getPuntoControl');
    Route::post('Conductor/{Conductor}/isInCheckpoint', 'ConductorController@goodPuntoControl');
    Route::post('Conductor/{Conductor}/Reportar','ConductorController@badPuntoControl');
    Route::post('Round_Robinr/start','Round_RobinrController@startRoundRobin');
});

