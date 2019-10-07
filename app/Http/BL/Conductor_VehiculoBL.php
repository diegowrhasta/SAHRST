<?php

namespace App\Http\BL;

use App\Http\DAO\Conductor_VehiculoDAO;

class Conductor_VehiculoBL{
    public function prepareStore(array $data){
        $conductor_vehiculoDAO = new Conductor_VehiculoDAO;
        $resp = $conductor_vehiculoDAO->dbSaveConductor_Vehiculo($data);
        return $resp;
    }
}