<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Http\BL\ConductorBL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Image;

class ConductorController extends Controller
{
    public function __construct(){
        $this->middleware('checkBoss')->except(['show']);
    }

    public function store(Request $request){
        $rules = [
            'nombres'=>'bail|required|max:45',
            'ap_paterno'=>'bail|required|max:25',
            'ap_materno'=>'bail|required|max:25',
            'fecha_nacimiento'=>'bail|date',
            'ci'=>'bail|required|numeric',
            'direccion'=>'required',
            'celular'=>'bail|required|numeric',
            'telefono'=>'numeric',
        ];
        $msg = [
            'nombres.required'=>'El campo nombre es requerido',
            'nombres.max'=>'El campo nombre debe tener como máximo 45 caracteres',
            'ap_paterno.required'=>'El campo para apellido paterno es requerido',
            'ap_paterno.max'=>'El campo para apellido paterno debe tener como máximo 25 caracteres',
            'ap_materno.required'=>'El campo para apellido materno es requerido',
            'ap_materno.max'=>'El campo para apellido materno debe tener como máximo 25 caracteres',
            'fecha_nacimiento.date'=>'Formato de fecha es incorrecto',
            'ci.required'=>'Número de identificación requerido',
            'ci.numeric'=>'El campo CI debe ser de tipo numérico',
            'direccion.required'=>'La dirección es requerida',
            'celular.required'=>'El número de celular es requerido',
            'celular.numeric'=>'El número de celular debe ser numérico',
            'telefono.numeric'=>'El número de telef debe ser numérico',
        ];
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $data = $request->toArray();
        $conductorBL = new ConductorBL();
        $resp = $conductorBL->saveConductor($data);
        return $resp;

    }

    public function show($conductor_id){
        $conductorBL = new ConductorBL;
        $conductor = $conductorBL->prepareShow($conductor_id);
        if(!$conductor){
            return response()->json(['Message'=>'Conductor no se encontró','Code'=>404],404);
        }
        else{
            return response()->json([$conductor],200);
        }
    }
    public function index(){
        $conductorBL = new ConductorBL;
        $conductores = $conductorBL->getConductores();
        if(!$conductores){
            return response()->json(['Message'=>'No hay conductores registrados','Code'=>404],404);
        }
        else{
            return response()->json($conductores,200);
        }
    }

    public function update(Request $request, $conductor_id){
        $rules = [
            'nombres'=>'bail|required|max:45',
            'ap_paterno'=>'bail|required|max:25',
            'ap_materno'=>'bail|required|max:25',
            'fecha_nacimiento'=>'bail|date',
            'ci'=>'bail|required|numeric',
            'direccion'=>'required',
            'celular'=>'bail|required|numeric',
            'telefono'=>'numeric',
        ];
        $msg = [
            'nombres.required'=>'El campo nombre es requerido',
            'nombres.max'=>'El campo nombre debe tener como máximo 45 caracteres',
            'ap_paterno.required'=>'El campo para apellido paterno es requerido',
            'ap_paterno.max'=>'El campo para apellido paterno debe tener como máximo 25 caracteres',
            'ap_materno.required'=>'El campo para apellido materno es requerido',
            'ap_materno.max'=>'El campo para apellido materno debe tener como máximo 25 caracteres',
            'fecha_nacimiento.date'=>'Formato de fecha es incorrecto',
            'ci.required'=>'Número de identificación requerido',
            'ci.numeric'=>'El campo CI debe ser de tipo numérico',
            'direccion.required'=>'La dirección es requerida',
            'celular.required'=>'El número de celular es requerido',
            'celular.numeric'=>'El número de celular debe ser numérico',
            'telefono.numeric'=>'El número de telef debe ser numérico',
        ];
        $validator = Validator::make($request->json()->all(),$rules,$msg);
        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }
        else{
            $conductorBL = new ConductorBL; 
            $conductor_new = $request->json()->all();
            $response = $conductorBL->prepareUpdate($conductor_new,$conductor_id);
            if(!$response){
                return response()->json(['Message'=>'Edición fallida','Code'=>500],500);        
            }
            else{
                return response()->json(['Message'=>'Edición exitosa','Code'=>200],200);        
            }
        }
    }

    public function destroy($conductor_id){
        $conductorBL = new ConductorBL;
        $resp = $conductorBL->deleteConductor($conductor_id);
        if(!$resp){
            return response()->json(['Message'=>"Eliminación exitosa",'error_code'=>500],500);
        }
        else{
            return response()->json(['Message'=>"Eliminación fallida",'error_code'=>200],200);
        }
    }

    public function update_avatar(Request $request, $conductor_id){
        //Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
    		$conductor= Conductor::find($conductor_id);
    		$conductor->avatar = $filename;
    		$conductor->save();
        }
    }
    public function get_avatar($conductor_id){
        $conductor = Conductor::find($conductor_id);
        $avatar = $conductor->avatar;
        $img = Image::make(file_get_contents(public_path('/uploads/avatars/' . $avatar )));
        return $img->response();
    }
}
