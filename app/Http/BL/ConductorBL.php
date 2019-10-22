<?php
/**
 * Created by PhpStorm.
 * User: Yawar
 * Date: 10/9/2019
 * Time: 23:49
 */

namespace App\Http\BL;

use App\Http\DAO\ConductorDAO;
use App\Http\DAO\ReporteDAO;
use Image;

class ConductorBL
{
    public function saveConductor(array $data)
    {
        $conductorDAO = new ConductorDAO();
        $resp = $conductorDAO->dbSaveConductor($data);
        return $resp;
    }
    public function prepareShow($conductor_id){
        $conductorDAO = new ConductorDAO;
        $conductor = $conductorDAO->getConductor($conductor_id);
        if($conductor){
            return $conductor;
        }
        else{
            return response()->json([
                'message' => 'Conductor no encontrado',
                'code' => 404,
            ],404);
        }
    }
    public function getConductores(){
        $conductorDAO = new ConductorDAO;
        $conductores = $conductorDAO->getList();
        $count = $conductores->count();
        if($count<1){
            return false;
        }
        else{
            return $conductores;
        }
    }
    public function deleteConductor($conductor_id){
        $conductorDAO = new ConductorDAO;
        $check_conductor = $conductorDAO->getConductor($conductor_id);
        if($check_conductor){
            $resp = $conductorDAO->dbDeleteConductor($conductor_id);
            return $resp;
        }
        else{
            return response()->json([
                'message' => 'invalid Conductor',
                'code' => 400,
            ],400);
        }
    }
    public function prepareUpdate($conductor_new,$conductor_id){
        $conductorDAO = new ConductorDAO;
        $conductor_old = $conductorDAO->getConductor($conductor_id);
        if($conductor_old){
            $conductor_old -> nombres = $conductor_new['nombres'];
            $conductor_old -> ap_paterno = $conductor_new['ap_paterno'];
            $conductor_old -> ap_materno = $conductor_new['ap_materno'];
            $conductor_old -> fecha_nacimiento = $conductor_new['fecha_nacimiento'];
            $conductor_old -> ci = $conductor_new['ci'];
            $conductor_old -> direccion = $conductor_new['direccion'];
            $conductor_old -> celular = $conductor_new['celular'];
            $conductor_old -> telefono = $conductor_new['telefono'];
            $conductor_old -> ruta_id = $conductor_new['ruta_id'];
            $conductor_old -> next_punto_control = $conductor_new['next_punto_control'];
            if(!$conductorDAO->dbEditConductor($conductor_old)){
                return response()->json([
                    'message'=>'Edición fallida',
                    'code'=>500,
                ],500);
            }
            else{
                return response()->json([
                    'message'=>'Edición exitosa',
                    'code'=>201,
                ],201);
            }
        }
        else{
            return response()->json([
                'message'=>'Conductor inválido',
                'code'=>404,
            ],404);
        }
    }
    public function prepareProfilePic($avatar, $filename, $conductor_id){
        $conductorDAO = new ConductorDAO;
        $conductor = $conductorDAO->getConductor($conductor_id);
        if(!$conductor){
            return response()->json([
                'message' => 'conductor not found',
                'code' => 404,
            ],404);
        }
        else{
            $conductor->avatar = $filename;
            $resp_pic = $conductorDAO->UploadProfilePic($avatar,$filename);
            $resp_edit = $conductorDAO->dbEditConductor($conductor);
            if($resp_edit){
                return $resp_pic;
            }
            else{
                return false;
            }
        }
    }
    public function getProfilePic($conductor_id){
        $conductorDAO = new ConductorDAO;
        $conductor = $conductorDAO->getConductor($conductor_id);
        if($conductor){
            $avatar = $conductor->avatar;
            $profile_pic = $conductorDAO->retrieveProfilePic($avatar);
            if(!$profile_pic){
                return false;
            }
            else{
                return $profile_pic->response();
            }
        }
        else{
            return response()->json([
                'message' => 'Conductor not found',
                'code' => 404,
            ], 404);
        }
        
    }
    public function retrieveNextPuntoControl($conductor_id){
        $conductorDAO = new ConductorDAO;
        $conductor = $conductorDAO->getConductor($conductor_id);
        if($conductor){
            $nextPuntoControl = $conductorDAO->dbGetConductorNextPuntoControl($conductor_id);
            if($nextPuntoControl){
                return response()->json($nextPuntoControl,200);
            }
            else{
                return response()->json([
                    'Error'=> 'Error interno del servidor',
                ], 500);
            }
        }
        else{
            return response()->json([
                "message" => 'Conductor invalid',
                'code' => 404,
            ],404);
        }
    }
    public function passNextCheckPoint(array $token, $conductor_id){
        if($token['pass'] && is_bool($token['pass'])){
            $conductorDAO = new ConductorDAO;
            $check_conductor = $conductorDAO->getConductor($conductor_id);
            if(!$check_conductor){
                return response()->json([
                    'message' => "conductor not found",
                    'code' => 404
                ],404);
            }
            else{
                $resp = $conductorDAO->dbAdvanceCheckpoint($conductor_id);
                return $resp;
            }
        }
        else{
            return response()->json([
                'message' => 'Body not valid',
                'code' => 400,
            ],400);
        }
    }
    public function preparereportConductor(array $data, $conductor_id){
        if($data['conductor_id']==$conductor_id){
            $reporteDAO = new ReporteDAO;
            $resp = $reporteDAO->dbStoreReporte($data);
            $conductorDAO = new ConductorDAO;
            $conductor = $conductorDAO -> getConductor($conductor_id);
            $conductor -> ruta_id = null;
            $conductor -> next_punto_control = null;
            $finalresponse = $conductorDAO -> dbEditConductor($conductor);
            if($finalresponse){
                return $resp;
            }
            else{
                return response()->json([
                    'message' => 'Could not save Reporte',
                    'code' => 500,
                ],500);
            }
        }
        else{
            return response()->json([
                'message' => 'Body not valid',
                'code' => 400,
            ],400);
        }
    }
}