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
}