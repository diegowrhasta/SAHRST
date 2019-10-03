<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Http\BL\ConductorBL;
use App\Http\BL\RutaBL;
use App\Http\POPO\msg;
use App\Http\POPO\rules;
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
        $msgClass = new msg;
        $rulesClass = new rules;
        $msg = $msgClass->messagesConductor();
        $rules = $rulesClass->rulesConductor();
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
            return response()->json($conductor,200);
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
        $msgClass = new msg;
        $rulesClass = new rules;
        $msg = $msgClass->messagesConductor();
        $rules = $rulesClass->rulesConductor();
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
            return response()->json(['Message'=>"Eliminación fallida",'error_code'=>500],500);
        }
        else{
            return response()->json(['Message'=>"Eliminación exitosa",'error_code'=>200],200);
        }
    }

    public function update_avatar(Request $request, $conductor_id){
        //Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $conductor_id . '.' . $avatar->getClientOriginalExtension();
            $conductorBL = new ConductorBL;
            $resp = $conductorBL->prepareProfilePic($avatar,$filename,$conductor_id);
            return $resp;
        }
    }
    public function get_avatar($conductor_id){
        $conductorBL = new ConductorBL;
        $profile_pic = $conductorBL->getProfilePic($conductor_id);
        if(!$profile_pic){
            return response()->json([
                'Message'=>'Imagen no encontrada',
                'Code'=>404
            ],400);
        }
        else{
            return $profile_pic->response();
        }
    }
    public function retrieveRoute($conductor_id){
        $rutaBL = new RutaBL;
        $nextRoute = $rutaBL->getNextRoute($conductor_id);
        return response()->json([$nextRoute],200);
    }
}
