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
}