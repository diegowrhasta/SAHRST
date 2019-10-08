<?php

namespace App\Http\DAO;

use App\Reporte;

class ReporteDAO{
    public function dbStoreReporte($data){
        try{
            Reporte::create($data);
            return response()->json([
                "message" => 'Reporte Registrado',
                'code' => 202
            ],202);
        }  catch (QueryException $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        } catch (\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 500);
        }
    }
}