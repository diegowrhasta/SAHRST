<?php

namespace App\Http\BL;

use App\Http\DAO\Tipo_PuntoDAO;

class Tipo_PuntoBL
{
    public function saveTipo_Punto(array $data)
    {
        $tipo_puntaDAO = new Tipo_PuntoDAO;
        $resp = $tipo_puntaDAO->dbSaveTipo_Punto($data);
        return $resp;
    }
}