<?php

namespace App\Http\DAO;

use App\Reporte;

class ReporteDAO{
    public function dbStoreReporte($data){
        try{
            Reporte::create($data);
            return response()->json([
                "message" => 'Reporte Registrado',
                'code' => 201
            ],201);
        }  catch (QueryException $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
                'Error_Line'=>$exception->getLine(),
            ], 400);
        } catch (\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
                'Error_Line'=>$exception->getLine(),
            ], 500);
        }
    }
}