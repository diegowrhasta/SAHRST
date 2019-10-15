<?php

namespace App\Http\BL;

use App\Http\DAO\Tipo_PuntoDAO;

class Tipo_PuntoBL
{
    public function saveTipo_Punto(array $data)
    {
        $tipo_puntoDAO = new Tipo_PuntoDAO;
        $resp = $tipo_puntoDAO->dbSaveTipo_Punto($data);
        return $resp;
    }
    public function prepareShow($tipo_punto_id){
        if($tipo_punto_id==null){
            return false;
        }
        else{
            $tipo_puntoDAO = new Tipo_PuntoDAO;
            $check_tipo_punto = $tipo_puntoDAO->getTipo_Punto($tipo_punto_id);
            if($check_tipo_punto){
                return response()->json($check_tipo_punto,200);
            }
            else{
                return response()->json([
                    'message' => 'Tipo_Punto not found',
                    'code' => 404,
                ],404);
            }
        }
    }
    public function getTipos_Punto(){
        $tipo_puntoDAO = new Tipo_PuntoDAO;
        $tipos_punto = $tipo_puntoDAO->getList();
        $count = $tipos_punto->count();
        if($count<1){
            return false;
        }
        else{
            return $tipos_punto;
        }
    }
}