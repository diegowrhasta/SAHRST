<?php

namespace App\Http\Controllers;

use App\Http\BL\VehiculoBL;
use App\Http\POPO\msg;
use App\Http\POPO\rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    public function index(){
        $vehiculoBL = new VehiculoBL;
        $vehiculos = $vehiculoBL->getVehiculos();
        return $vehiculos;
    }
    public function store(Request $request){
        $msgClass = new msg;
        $rulesClass = new rules;
        $vehiculoBL = new VehiculoBL;
        $msg = $msgClass->messagesVehiculo();
        $rules = $rulesClass->rulesVehiculo();
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $resp = $vehiculoBL->prepareStore($data);
        return $resp;
    }
}
