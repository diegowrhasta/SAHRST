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
        if($resp){
            return $resp;
        }
        return response()->json([
            'message' => 'Ruta not found',
            'code' => 404,
        ],404);
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
            return response()->json([
                'message'=> 'Could not update next route',
                'code'=>500,
            ], 500);
        }
        return response()->json([
            'message'=> 'Invalid number of routes or invalid conductor_id',
            'code'=>400,
        ], 400);
    }
    public function prepareUpdateRoute($new_route,$ruta_id){
        $rutaDAO = new RutaDAO;
        $old_route = $rutaDAO->dbGetRoute($ruta_id);
        if($old_route){
            $old_route -> nombre = $new_route['nombre'];
            $resp = $rutaDAO -> dbUpdateRoute($old_route);
            return $resp;
        }
        return response()->json([
            'message'=> 'Invalid Route',
            'code'=>400,
        ], 400);
    }
    public function nextRoute($countRoutes,$current,$checkConductor,$conductor_id){
        try{
            $updatedValue = 0;
            if($current==$countRoutes){
                $updatedValue = 1;
            }
            $updatedValue = $current+1;
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
    public function prepareDestroy($ruta_id){
        $rutaDAO = new RutaDAO;
        $checkRoute = $rutaDAO->dbGetRoute($ruta_id);
        if($checkRoute){
            $resp = $rutaDAO -> dbRutaDestroy($ruta_id);
            return $resp;
        }
        return response()->json([
            'message'=> 'Invalid Route',
            'code'=>400,
        ], 400);
    }
}
