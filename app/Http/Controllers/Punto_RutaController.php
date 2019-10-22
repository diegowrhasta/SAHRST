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
            'posicion'=>'bail|required|int'
        ];
        $msg = [
            'punto_id.numeric'=>'El campo punto_id debe ser numérico',
            'punto_id.required'=>'El campo punto_id es requerido',
            'ruta_id.numeric'=>'El campo ruta_id debe ser numérico',
            'ruta_id.required'=>'El campo ruta_id es requerido',
            'posicion.numeric'=>'El campo posicion debe ser entero',
            'posicion.required'=>'El campo posicion es requerido',
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
            return response()->json([
                'message'=>'No hay relaciones entre puntos y rutas',
                'code'=>404
            ],404);
        }
        else{
            return response()->json($puntos_ruta,200);
        }
    }
}
