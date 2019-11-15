<?php

namespace App\Http\Controllers;

use App\Http\BL\ReporteBL;
use Illuminate\Http\Request;
use Tests\TestingConstants;

class ReporteController extends Controller
{
    public function store(Request $request,$conductor_id){
        $reporteBL = new ReporteBL;
        $data = $request->toArray();
        if($data['conductor_id']==$conductor_id){
            $resp = $reporteBL->prepareStore($data);
            return $resp;
        }
        return response()->json([
                'message' => 'Body not valid',
                'code' => 400,
        ],400);
    }
    public function testResponse(){
        $testingConstantsClass = new TestingConstants;
        $request = new Request;
        $request = $request::create('/api/Round_Robinr/start', 'POST', [], [], [], [], 
        '{
            "command"'.': '.'"start"
        }'
        );
        $request->headers->set('Authorization','Bearer '.$testingConstantsClass->getTokenBearer());
        $request->headers->set('Content-Type','application/json');
    }
}
