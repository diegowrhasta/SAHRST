<?php

namespace App\Http\BL;

use App\Http\DAO\PuntoDAO;

class PuntoBL
{
    public function savePunto(array $data)
    {
        $puntoDAO = new PuntoDAO;
        $resp = $puntoDAO->dbSavePunto($data);
        return $resp;
    }
    public function prepareGetPunto($punto_id){
        $puntoDAO = new PuntoDAO;
        $resp = $puntoDAO->dbGetPunto($punto_id);
        if($resp){
            return $resp;
        }
        return response()->json([
            'message' => 'Punto no encontrado',
            'code' => 404,
        ],404);
    }
    public function getPuntos(){
        $puntoDAO = new PuntoDAO;
        $resp = $puntoDAO->dbGetPuntos();
        return $resp;
    }
    public function getFirstPuntoControl($conductor_id){
        $puntoDAO = new PuntoDAO;
        $puntosControlFromConductor = $puntoDAO->dbGetPuntosControlFromConductor($conductor_id);
        $firstControlPoint = $puntosControlFromConductor[0];
        $FirstControlPointID = $firstControlPoint -> punto_id;
        return $FirstControlPointID;
    }
}