<?php

namespace App\Http\BL;

use App\Http\DAO\Conductor_VehiculoDAO;
use App\Http\DAO\ConductorDAO;

class Conductor_VehiculoBL{
    public function prepareStore(array $data){
        $conductorDAO = new ConductorDAO;
        $check_Conductor = $conductorDAO->getConductor($data['conductor_id']);
        if($check_Conductor){
            $conductor_vehiculoDAO = new Conductor_VehiculoDAO;
            $resp = $conductor_vehiculoDAO->dbSaveConductor_Vehiculo($data);
            return $resp;
        }
        return response()->json([
            'message' => 'Conductor not found',
            'code' => 404,
        ],404);
    }
    public function prepareAll(){
        $conductor_vehiculoDAO = new Conductor_VehiculoDAO;
        $resp = $conductor_vehiculoDAO->dbGetAll();
        if(count($resp)<1){
            return response()->json([
                'message' => 'No conductores_vehiculo found',
                'code' => 404,
            ],404);
        }
        return $resp;
    }
}