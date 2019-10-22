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
        else{
            $data = $request->toArray();
            $rutaBL = new RutaBL;
            $resp = $rutaBL->saveRuta($data);
            return $resp;   
        }
    }
    public function index(){
        $rutaBL = new RutaBL;
        $routes = $rutaBL->getRoutes();
        if(!$routes){
            return response()->json([
                'message'=>'No hay rutas registradas',
                'code'=>404
            ],404);
        }
        else{
            return response()->json($routes,200);
        }
    }
    public function show($ruta_id){
        $rutaBL = new RutaBL;
        $ruta = $rutaBL->getRoute($ruta_id);
        return $ruta;
    }
}
