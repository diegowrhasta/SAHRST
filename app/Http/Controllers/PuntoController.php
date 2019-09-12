<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\BL\PuntoBL;

class PuntoController extends Controller
{
    public function store(Request $request){
        $rules = [
            'nombre'=>'bail|required|max:45',
            'tipo_punto_id'=>'bail|required|numeric'
        ];
        $msg = [
            'nombre.required'=>'El campo nombre es requerido',
            'tipo_punto_id.numeric'=>'El campo debe ser numérico',
        ];
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        else{
            $data = $request->toArray();
            $puntoBL = new PuntoBL;
            $resp = $puntoBL->savePunto($data);
            return $resp;
        }
    }
}
