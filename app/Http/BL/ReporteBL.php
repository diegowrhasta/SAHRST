<?php

namespace App\Http\BL;

use App\Http\DAO\ReporteDAO;

class ReporteBL{
    public function prepareStore(array $data){
        $reporteDAO = new ReporteDAO;
        $resp = $reporteDAO->dbStoreReporte($data);
        return $resp;
    }
}