<?php

namespace App\Http\DAO;

use App\Vehiculo;
use Exception;

class VehiculoDAO{
    public function getList(){
        try{
            $vehiculos=Vehiculo::all();
            return $vehiculos;
        }
        catch(Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 500);
        }
    }
    public function dbSaveVehiculo($data){
        try{
            Vehiculo::create($data);
            return response()->json(['message'=>'Vehiculo registrado correctamente','code'=>202],202);
        } catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        } catch (\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
    public function dbGetVehiculo($vehiculo_id){
        try{
            $vehiculo = Vehiculo::find($vehiculo_id);
            return $vehiculo;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
    public function dbUpdateVehiculo($updatedVehicle){
        try{
            $updatedVehicle->save();
            return response()->json([
                'message' => 'Vehiculo updated',
                'code' => 202,
            ],202);
        }
        catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
    public function dbDeleteVehiculo($vehiculo_id){
        try{
            Vehiculo::destroy($vehiculo_id);
            return response()->json([
                'message' => 'Vehicle deleted',
                'code' => 200,
            ],200);
        }
        catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
}