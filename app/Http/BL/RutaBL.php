<?php

namespace App\Http\BL;

use App\Http\DAO\ConductorDAO;
use App\Http\DAO\RutaDAO;
use App\Http\BL\PuntoBL;

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
            $current = $nextRoute[0]['next_ruta_id'];
            $resp = $this->nextRoute($countRoutes,$current,$checkConductor,$conductor_id);
            if($resp){
                return $nextRoute;
            }
            else{
                return response()->json([
                    'message'=> 'Could not update next route',
                    'code'=>500,
                ], 500);
            }
        }
        else{
            return response()->json([
                'message'=> 'Invalid number of routes or invalid conductor_id',
                'code'=>400,
            ], 400);
        }
    }
    function nextRoute($countRoutes,$current,$checkConductor,$conductor_id){
        try{
            $updatedValue = 0;
            if(($current+1)>$countRoutes){
                $updatedValue = 1;
            }
            else{
                $updatedValue = $countRoutes++;
            }
            $rutaDAO = new RutaDAO;
            $conductorDAO = new ConductorDAO;
            $puntoBL = new PuntoBL;
            $rutaDAO->updateNextRoute($updatedValue);
            $checkConductor -> ruta_id = $current;
            $conductorDAO -> dbEditConductor($checkConductor);
            $theNextPunto = $puntoBL->getFirstPuntoControl($conductor_id);
            $checkConductor -> next_punto_control = $theNextPunto;
            $conductorDAO -> dbEditConductor($checkConductor);
            return true;
        }
        catch(\Exception $exception){
            return false;
        }
    }
}
