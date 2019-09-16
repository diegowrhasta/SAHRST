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
    
}
