<?php

namespace App\Http\DAO;

use App\Conductor_Vehiculo;
use Illuminate\Database\QueryException;

class Conductor_VehiculoDAO{
    public function dbSaveConductor_Vehiculo(array $data){
        try{
            $conductor_vehiculo = new Conductor_Vehiculo;
            $conductor_vehiculo::create($data);
            return response()->json([
                'message' => 'Conductor_Vehiculo registrado exitosamente',
                'code' => 202,
            ],202);
        }
        catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        } catch (\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
                'Line' => $exception->getLine(),
            ], 500);
        }
    }
    public function dbGetAll(){
        try{
            $conductor_vehiculo = new Conductor_Vehiculo;
            $resp = $conductor_vehiculo::all();
            return $resp;
        }
        catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        } catch (\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
                'Line' => $exception->getLine(),
            ], 500);
        }
    }
}