<?php

namespace App\Http\DAO;

use App\Conductor_Vehiculo;

class Conductor_VehiculoDAO{
    public function dbSaveConductor_Vehiculo(array $data){
        try{
            Conductor_Vehiculo::create($data);
            return response()->json([
                'message' => 'Conductor_Vehiculo registrado exitosamente',
                'code' => 202,
            ]);
        }
        catch (QueryException $exception){
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