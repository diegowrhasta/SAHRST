<?php

namespace App\Http\DAO;

use App\Vehiculo;
use Exception;
use Illuminate\Support\Facades\DB;

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
    public function dbGetVehiculobyIdFromConductor($conductor_id,$vehiculo_id){
        try{
            $vehiculo = DB::select('select a.vehiculo_id, a.placa, a.modelo, a.marca, a.color from vehiculos a, conductores b, conductor_vehiculo c 
            where a.vehiculo_id = ?
            and b.conductor_id = ?
            and c.vehiculo_id = a.vehiculo_id
            and c.conductor_id = b.conductor_id', [$vehiculo_id,$conductor_id]);
            if($vehiculo){
                return response()->json($vehiculo[0],200);
            }
            else{
                return response()->json([
                    'message' => 'Vehicle not found',
                    'code' => 404,
                ]);
            }
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
    public function dbGetVehiculosFromConductor($conductor_id){
        try{
            $vehiculos = DB::select('select a.vehiculo_id, a.placa, a.modelo, a.marca, a.color from vehiculos a, conductores b, conductor_vehiculo c 
            where b.conductor_id = ?
            and b.conductor_id = c.conductor_id 
            and a.vehiculo_id = c.vehiculo_id', [$conductor_id]);
            if($vehiculos){
                return response()->json($vehiculos,200);
            }
            else{
                return response()->json([
                    'message' => 'No Vehicles',
                    'code' => 404,
                ]);
            }
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