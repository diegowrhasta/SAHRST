<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\BL\Punto_RutaBL;
use Illuminate\Support\Facades\Validator;

class Punto_RutaController extends Controller
{
    public function store(Request $request){
        $rules = [
            'punto_id'=>'bail|required|numeric',
            'ruta_id'=>'bail|required|numeric',
        ];
        $msg = [
            'punto_id.numeric'=>'El campo debe ser numérico',
            'punto_id.required'=>'El campo es requerido',
            'ruta_id.numeric'=>'El campo debe ser numérico',
            'ruta_id.required'=>'El campo es requerido',
        ];
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        else{
            $data = $request->toArray();
            $punto_rutaBL = new Punto_RutaBL;
            $resp = $punto_rutaBL->savePunto_Ruta($data);
            return $resp;
        }
    }
    public function index(){
        $Punto_RutaBL = new Punto_RutaBL;
        $puntos_ruta = $Punto_RutaBL->getPuntos_Ruta();
        if(!$puntos_ruta){
            return response()->json(['Message'=>'No hay relaciones entre puntos y rutas','Code'=>404],404);
        }
        else{
            return response()->json(['data'=>$puntos_ruta],200);
        }
    }
}
