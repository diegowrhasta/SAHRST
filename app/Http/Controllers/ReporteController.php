<?php

namespace App\Http\Controllers;

use App\Http\BL\ReporteBL;
use Illuminate\Http\Request;

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
}
