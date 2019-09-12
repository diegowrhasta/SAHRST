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
}
