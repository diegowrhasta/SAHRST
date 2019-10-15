<?php

namespace App\Http\DAO;

use App\Round_Robinr;
use App\Ruta;
use Illuminate\Support\Facades\DB;

class Round_RobinrDAO{
    public function dbStartRound(){
        try{
            $rutas = Ruta::all();
            $check_round = Round_Robinr::find(1);
            if($check_round){
                if(count($rutas)>1){
                    DB::update('update round_robinr set next_ruta_id = ? where round_robin_id = 1', [1]);
                    return response([
                        'message' => 'Route Started!',
                        'code' => 201,
                    ],201);
                }
                else{
                    return response([
                        'message' => 'Not enough routes registered',
                        'code' => 404,
                    ],404);
                }
            }
            else{
                if(count($rutas)>1){
                    DB::insert('insert into round_robinr (next_ruta_id) values (null)');
                    DB::update('update round_robinr set next_ruta_id = ? where round_robin_id = 1', [1]);
                    return response([
                        'message' => 'Route Started!',
                        'code' => 201,
                    ],201);
                }
                else{
                    return response([
                        'message' => 'Not enough routes registered',
                        'code' => 404,
                    ],404);
                }
            }
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 500);
        }
    }
}