<?php
/**
 * Created by PhpStorm.
 * User: Yawar
 * Date: 10/9/2019
 * Time: 23:49
 */

namespace App\Http\BL;


use App\Http\DAO\ConductorDAO;
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
        if($conductor_id==null){
            return false;
        }
        else{
            $conductorDAO = new ConductorDAO;
            $check_conductor = $conductorDAO->getConductor($conductor_id);
            if(!$check_conductor){
                return false;
            }
            else{
                return $check_conductor;
            }
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
        $resp = $conductorDAO->dbDeleteConductor($conductor_id);
        return $resp;
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
            if(!$conductorDAO->dbEditConductor($conductor_old)){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }

    }
    public function prepareProfilePic($avatar, $filename, $conductor_id){
        $conductorDAO = new ConductorDAO;
        $conductor = $conductorDAO->getConductor($conductor_id);
        if(!$conductor){
            return false;
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
        $avatar = $conductor->avatar;
        $profile_pic = $conductorDAO->retrieveProfilePic($avatar);
        if(!$profile_pic){
            return false;
        }
        else{
            return $profile_pic;
        }
    }
}