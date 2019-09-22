<?php

namespace App\Http\BL;

use App\Http\DAO\RutaDAO;

class RutaBL
{
    public function saveRuta(array $data)
    {
        $rutaDAO = new RutaDAO();
        $resp = $rutaDAO->dbSaveRuta($data);
        return $resp;
    }
    public function getRoutes(){
        $rutaDAO = new RutaDAO;
        $resp = $rutaDAO->dbGetRoutes();
        return $resp;
    }
    public function getRoute($ruta_id){
        $rutaDAO = new RutaDAO;
        $resp = $rutaDAO->dbGetRoute($ruta_id);
        return $resp;
    }
}
