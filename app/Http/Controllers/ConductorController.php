<?php

namespace App\Http\Controllers;

use App\Http\BL\ConductorBL;
use App\Http\BL\RutaBL;
use App\Http\BL\VehiculoBL;
use App\Http\POPO\msg;
use App\Http\POPO\rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConductorController extends Controller
{
    // Save Conductor
    public function store(Request $request){
        $msgClass = new msg;
        $rulesClass = new rules;
        $msg = $msgClass->messagesConductor();
        $rules = $rulesClass->rulesConductor();
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $conductorBL = new ConductorBL();
        $resp = $conductorBL->saveConductor($data);
        return $resp;
    }

    //Show Conductor by id
    public function show($conductor_id){
        $conductorBL = new ConductorBL;
        $conductor = $conductorBL->prepareShow($conductor_id);
        return $conductor;
    }
    public function index(){
        $conductorBL = new ConductorBL;
        $conductores = $conductorBL->getConductores();
        if(!$conductores){
            return response()->json([
                'message'=>'No hay conductores registrados',
                'code'=>404,
            ],404);
        }
        else{
            return response()->json($conductores,200);
        }
    }

    //Get Avatar
    public function get_avatar($conductor_id){
        $conductorBL = new ConductorBL;
        $profile_pic = $conductorBL->getProfilePic($conductor_id);
        return $profile_pic;
    }

    //Assign Route
    public function retrieveRoute($conductor_id){
        $rutaBL = new RutaBL;
        $nextRoute = $rutaBL->getNextRoute($conductor_id);
        return $nextRoute;
    }

    //Get i assigned Vehiculo
    public function getVehiculo($conductor_id,$vehiculo_id){
        $vehiculoBL = new VehiculoBL;
        $resp = $vehiculoBL->getConductorVehiculobyId($conductor_id,$vehiculo_id);
        return $resp;
    }

    //Get list of assigned Vehiculos
    public function getVehiculos($conductor_id){
        $vehiculoBL = new VehiculoBL;
        $resp = $vehiculoBL->getConductorVehiculos($conductor_id);
        return $resp;
    }

    //Retrieve Conductor's PuntoControl
    public function getPuntoControl($conductor_id){
        $conductorBL = new ConductorBL;
        $resp = $conductorBL->retrieveNextPuntoControl($conductor_id);
        return $resp;
    }

    //Update Conductor
    public function update(Request $request, $conductor_id){
        $msgClass = new msg;
        $rulesClass = new rules;
        $msg = $msgClass->messagesConductor();
        $rules = $rulesClass->rulesConductor();
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
                return response()->json($validator->messages(), 400);
        }
        else{
            $conductorBL = new ConductorBL; 
            $conductor_new = $request->json()->all();
            $response = $conductorBL->prepareUpdate($conductor_new,$conductor_id);
            return $response;
        }
    }

    //Update Avatar
    public function update_avatar(Request $request, $conductor_id){
        //Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $conductor_id . '.' . $avatar->getClientOriginalExtension();
            $conductorBL = new ConductorBL;
            $resp = $conductorBL->prepareProfilePic($avatar,$filename,$conductor_id);
            return $resp;
        }
    }

    //Roll to next Punto Control
    public function goodPuntoControl(Request $request, $conductor_id){
        $conductorBL = new ConductorBL;
        $token = $request->toArray();
        $resp = $conductorBL->passNextCheckPoint($token,$conductor_id);
        return $resp;
    }

    //Report Bad Conductor
    public function badPuntoControl(Request $request, $conductor_id){
        $conductorBL = new ConductorBL;
        $token = $request->toArray();
        $resp = $conductorBL->preparereportConductor($token,$conductor_id);
        return $resp;
    }

    //Delete Conductor
    public function destroy($conductor_id){
        $conductorBL = new ConductorBL;
        $resp = $conductorBL->deleteConductor($conductor_id);
        return $resp;
    }
}
