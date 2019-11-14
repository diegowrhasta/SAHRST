<?php

namespace App\Http\DAO;

use App\Round_Robinr;
use App\Ruta;
use Illuminate\Support\Facades\DB;

class Round_RobinrDAO{
    public function dbStartRound(){
        try{
            $rutas = new Ruta;
            $rutas::all();
            $check_round = new Round_Robinr;
            $check_round::find(1);
            $db = new DB;
            if($check_round){
                if(count($rutas)>1){
                    $db::update('update round_robinr set next_ruta_id = ? where round_robin_id = 1', [1]);
                    return response([
                        'message' => 'Route Started!',
                        'code' => 201,
                    ],201);
                }
                return response([
                    'message' => 'Not enough routes registered',
                    'code' => 404,
                ],404);
            }
            if(count($rutas)>1){
                $db::insert('insert into round_robinr (next_ruta_id) values (null)');
                $db::update('update round_robinr set next_ruta_id = ? where round_robin_id = 1', [1]);
                return response([
                        'message' => 'Route Started!',
                        'code' => 201,
                ],201);
            }
            return response([
                'message' => 'Not enough routes registered',
                'code' => 404,
            ],404);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 500);
        }
    }
}