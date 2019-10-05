<?php

namespace App\Http\BL;

use App\Http\DAO\VehiculoDAO;

class VehiculoBL{
    public function getVehiculos(){
        $vehiculoDAO = new VehiculoDAO;
        $vehiculos = $vehiculoDAO->getList();
        if(count($vehiculos)==0 || !$vehiculos){
            return response()->json([
                'Message' =>'No hay vehículos registrados',
                'Code' => 404
            ], 404);
        }
        else{
            return response()->json([$vehiculos],200);
        }
    }
    public function prepareStore($data){
        $vehiculoDAO = new VehiculoDAO;
        $resp = $vehiculoDAO->dbSaveVehiculo($data);
        return $resp;
    }
}