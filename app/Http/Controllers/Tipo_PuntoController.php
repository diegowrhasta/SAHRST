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
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        else{
            $data = $request->toArray();
            $tipo_puntoBL = new Tipo_PuntoBL;
            $resp = $tipo_puntoBL->saveTipo_Punto($data);
            return $resp;
        }
    }
    public function show($tipo_punto_id){
        $tipo_puntoBL = new Tipo_PuntoBL;
        $tipo_punto = $tipo_puntoBL->prepareShow($tipo_punto_id);
        if(!$tipo_punto){
            return response()->json(['Message'=>'No se encontró el tipo de punto','Code'=>404],404);
        }
        else{
            return response()->json([$tipo_punto],200);
        }
    }
}
