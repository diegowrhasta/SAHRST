<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\BL\PuntoBL;
use App\Http\POPO\msg;
use App\Http\POPO\rules;

class PuntoController extends Controller
{
    public function store(Request $request){
        $rulesClass = new rules;
        $msgClass = new msg;
        $rules = $rulesClass->rulesPunto();
        $msg = $msgClass->messagesPunto();
        $validator = new Validator;
        $validator = $validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $puntoBL = new PuntoBL;
        $resp = $puntoBL->savePunto($data);
        return $resp;
    }
    public function index(){
        $puntoBL = new PuntoBL;
        $puntos = $puntoBL->getPuntos();
        if(!$puntos){
            return response()->json([
                'message'=>'No hay puntos registrados',
                'code'=>404
            ],404);
        }
        return response()->json(
            $puntos
        ,200);
    }
    public function show($punto_id){
        $puntoBL = new PuntoBL;
        $resp = $puntoBL->prepareGetPunto($punto_id);
        return $resp;
    }
}
