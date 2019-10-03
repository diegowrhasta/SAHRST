<?php

namespace App\Http\BL;

use App\Http\DAO\ConductorDAO;
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
        $resp = $rutaDAO->dbGetRutas();
        return $resp;
    }
    public function getRoute($ruta_id){
        $rutaDAO = new RutaDAO;
        $resp = $rutaDAO->dbGetRoute($ruta_id);
        return $resp;
    }
    public function getNextRoute($conductor_id){
        $rutaDAO = new RutaDAO;
        $conductorDAO = new ConductorDAO;
        $countRoutes = count($rutaDAO->dbGetRutas());
        $checkConductor = $conductorDAO->getConductor($conductor_id);
        if($countRoutes>1 && $checkConductor){
            $nextRoute = $rutaDAO->retrieveNextRoute();
            $max = $nextRoute[0]['next_ruta_id'];
            $resp = $this->nextRoute($countRoutes,$max);
            if($resp){
                return $nextRoute;
            }
            else{
                return response()->json([
                    'Error'=> 'Could not update next route',
                    'Code'=>500,
                ], 500);
            }
        }
        else{
            return response()->json([
                'Error'=> 'Invalid number of routes or invalid conductor_id',
                'Code'=>400,
            ], 400);
        }
    }
    public function nextRoute($countRoutes,$max){
        try{
            $updatedValue = 0;
            if(($max+1)>$countRoutes){
                $updatedValue = 1;
            }
            else{
                $updatedValue = $countRoutes++;
            }
            $rutaDAO = new RutaDAO;
            $rutaDAO->updateNextRoute($updatedValue);
            return true;
        }
        catch(\Exception $exception){
            return false;
        }
    }
}
