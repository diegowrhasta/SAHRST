<?php

namespace App\Http\BL;

use App\Http\DAO\Round_RobinrDAO;

class Round_RobinrBL{
    public function prepareRound($object){
        if($object['command']=='start'){
            $round_RobinrDAO = new Round_RobinrDAO;
            $resp = $round_RobinrDAO->dbStartRound();
            return $resp;
        }
        else{
            return response()->json([
                'message' => 'invalid command',
                'code' => 400,
            ],400);
        }
    }
}