<?php

namespace App\Http\Controllers;

use App\Http\BL\Conductor_VehiculoBL;
use App\Http\POPO\msg;
use App\Http\POPO\rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Conductor_VehiculoController extends Controller
{
    public function store(Request $request){
        $msgClass = new msg;
        $rulesClass = new rules;
        $msg = $msgClass->messagesConductor_Vehiculo();
        $rules = $rulesClass->rulesConductor_Vehiculo();
        $validator = new Validator;
        $validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $conductor_vehiculoBL = new Conductor_VehiculoBL;
        $resp = $conductor_vehiculoBL->prepareStore($data);
        return $resp;
    }
}
