<?php

namespace App\Http\Controllers;

use App\Http\BL\VehiculoBL;
use App\Http\POPO\msg;
use App\Http\POPO\rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    public function store(Request $request){
        $msgClass = new msg;
        $rulesClass = new rules;
        $vehiculoBL = new VehiculoBL;
        $msg = $msgClass->messagesVehiculo();
        $rules = $rulesClass->rulesVehiculo();
        $validator = new Validator;
        $validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $resp = $vehiculoBL->prepareStore($data);
        return $resp;
    }
    public function index(){
        $vehiculoBL = new VehiculoBL;
        $vehiculos = $vehiculoBL->getVehiculos();
        return $vehiculos;
    }
    public function show($vehiculo_id){
        $vehiculoBL = new VehiculoBL;
        $resp = $vehiculoBL->getVehiculo($vehiculo_id);
        return $resp;
    }
    public function update(Request $request,$vehiculo_id){
        $vehiculoBL = new VehiculoBL;
        $msgClass = new msg;
        $rulesClass = new rules;
        $vehiculoBL = new VehiculoBL;
        $msg = $msgClass->messagesVehiculo();
        $rules = $rulesClass->rulesVehiculo();
        $validator = new Validator;
        $validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $updated_vehicle = $request->json()->all();
        $resp = $vehiculoBL->prepareUpdate($updated_vehicle,$vehiculo_id);
        return $resp;
    }
    public function destroy($vehiculo_id){
        $vehiculoBL = new VehiculoBL;
        $resp = $vehiculoBL->prepareDestroy($vehiculo_id);
        return $resp;
    }
}
