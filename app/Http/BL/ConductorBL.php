<?php
/**
 * Created by PhpStorm.
 * User: Yawar
 * Date: 10/9/2019
 * Time: 23:49
 */

namespace App\Http\BL;


use App\Http\DAO\ConductorDAO;

class ConductorBL
{
    public function saveConductor(array $data)
    {
        $conductorDAO = new ConductorDAO();
        $resp = $conductorDAO->dbSaveConductor($data);
        return $resp;
    }
    public function prepareShow($conductor_id){
        if($conductor_id!=null){
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
}