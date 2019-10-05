<?php

namespace App\Http\DAO;

use App\Vehiculo;
use Exception;

class VehiculoDAO{
    public function getList(){
        try{
            $vehiculos=Vehiculo::all();
            return $vehiculos;
        }
        catch(Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 500);
        }
    }
    public function dbSaveVehiculo($data){
        try{
            Vehiculo::create($data);
            return response()->json(['message'=>'Vehiculo registrado correctamente','code'=>202],202);
        } catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        } catch (\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }

    }
}