<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\BL\RutaBL;

class RutaController extends Controller
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
        $data = $request->toArray();
        $rutaBL = new RutaBL;
        $resp = $rutaBL->saveConductor($data);
        return $resp;
    }
}
