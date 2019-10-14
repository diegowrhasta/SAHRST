<?php

namespace App\Http\Controllers;

use App\Http\BL\Round_RobinrBL;
use Illuminate\Http\Request;

class Round_RobinrController extends Controller
{
    public function startRoundRobin(Request $request){
        $object = $request->toArray();
        $round_RobinrBL = new Round_RobinrBL;
        $resp = $round_RobinrBL->prepareRound($object);
        return $resp;
    }
}
