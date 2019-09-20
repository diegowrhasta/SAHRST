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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource ('Conductor','ConductorController');

Route::resource('Ruta','RutaController');

Route::resource('Tipo_Punto', 'Tipo_PuntoController');

Route::resource('Punto_Ruta', 'Punto_RutaController');

Route::resource('Punto', 'PuntoController');
