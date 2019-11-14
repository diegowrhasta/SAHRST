<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\BL\Tipo_PuntoBL;

class Tipo_PuntoController extends Controller
{
    public function store(Request $request){
        $rules = [
            'nombre'=>'bail|required|max:45',
        ];
        $msg = [
            'nombre.required'=>'El campo nombre es requerido',
        ];
        $validator = new Validator;
        $validator = $validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $tipo_puntoBL = new Tipo_PuntoBL;
        $resp = $tipo_puntoBL->saveTipo_Punto($data);
        return $resp;
    }
    public function show($tipo_punto_id){
        $tipo_puntoBL = new Tipo_PuntoBL;
        $tipo_punto = $tipo_puntoBL->prepareShow($tipo_punto_id);
        return $tipo_punto;
    }
    public function index(){
        $tipo_puntoBL = new Tipo_PuntoBL;
        $tipos_punto = $tipo_puntoBL->getTipos_Punto();
        if(!$tipos_punto){
            return response()->json([
                'message'=>'No hay tipos de punto registrados',
                'code'=>404
            ],404);
        }
        return response()->json($tipos_punto,200);
    }
}
