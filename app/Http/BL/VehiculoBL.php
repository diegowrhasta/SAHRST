<?php

namespace App\Http\BL;

use App\Http\DAO\VehiculoDAO;

class VehiculoBL{
    public function prepareStore($data){
        $vehiculoDAO = new VehiculoDAO;
        $resp = $vehiculoDAO->dbSaveVehiculo($data);
        return $resp;
    }
    public function getVehiculo($vehiculo_id){
        $vehiculoDAO = new VehiculoDAO;
        $resp = $vehiculoDAO->dbGetVehiculo($vehiculo_id);
        return response()->json($resp,200);
    }
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
    public function prepareUpdate($vehicle_new,$vehiculo_id){
        $vehiculoDAO = new VehiculoDAO;
        $vehicle_old = $vehiculoDAO->dbgetVehiculo($vehiculo_id);
        if($vehicle_old){
            $vehicle_old -> placa = $vehicle_new['placa'];
            $vehicle_old -> modelo = $vehicle_new['modelo'];
            $vehicle_old -> marca = $vehicle_new['marca'];
            $vehicle_old -> color = $vehicle_new['color'];
            $resp = $vehiculoDAO->dbUpdateVehiculo($vehicle_old);
            return $resp;
        }
        else{
            return response()->json([
                'message' => 'Vehiculo not found',
                'code' => 404
            ],404);
        }
    }
    public function prepareDestroy($vehiculo_id){
        $vehiculoDAO = new VehiculoDAO;
        $resp = $vehiculoDAO->dbDeleteVehiculo($vehiculo_id);
        return $resp;
    }
    public function getConductorVehiculobyId($conductor_id,$vehiculo_id){
        $vehiculoDAO = new VehiculoDAO;
        $resp = $vehiculoDAO->dbGetVehiculobyIdFromConductor($conductor_id,$vehiculo_id);
        return $resp;
    }
    public function getConductorVehiculos($conductor_id){
        $vehiculoDAO = new VehiculoDAO;
        $resp = $vehiculoDAO->dbGetVehiculosFromConductor($conductor_id);
        return $resp;
    }
}