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
}