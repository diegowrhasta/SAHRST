<?php

namespace App\Http\BL;

use App\Http\DAO\Punto_RutaDAO;

class Punto_RutaBL
{
    public function savePunto_Ruta(array $data)
    {
        $punto_rutaDAO = new Punto_RutaDAO;
        $resp = $punto_rutaDAO->dbSavePunto_Ruta($data);
        return $resp;
    }
    public function getPuntos_Ruta(){
        $punto_rutaDAO = new Punto_RutaDAO;
        $resp = $punto_rutaDAO->dbGetPuntos_Ruta();
        return $resp;
    }
    public function prepareDestroy($punto_ruta_id){
        $punto_rutaDAO = new Punto_RutaDAO;
        $check = $punto_rutaDAO -> dbGetPunto_Ruta($punto_ruta_id);
        if($check){
            $resp = $punto_rutaDAO->dbDestroyPuntoRuta($punto_ruta_id);
            return $resp;
        }
        return response()->json([
            'message'=>'Relación inexistente',
            'code'=>400
        ],400);
    }
}