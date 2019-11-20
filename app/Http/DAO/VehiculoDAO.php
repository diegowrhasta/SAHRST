<?php

namespace App\Http\DAO;

use App\Vehiculo;
use Exception;
use Illuminate\Support\Facades\DB;

class VehiculoDAO{
    public function getList(){
        try{
            $vehiculos = new Vehiculo;
            $vehiculos = $vehiculos::all();
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
            $vehiculo = new Vehiculo;
            $vehiculo = $vehiculo::create($data);
            return response()->json($vehiculo,201);
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
            $vehiculo = new Vehiculo;
            $vehiculo = $vehiculo::find($vehiculo_id);
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
                'message' => 'vehiculo updated',
                'code' => 201,
            ],201);
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
            $vehiculo = new Vehiculo;
            $vehiculo::destroy($vehiculo_id);
            return response()->json([
                'message' => 'vehiculo deleted',
                'code' => 201,
            ],201);
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
            $db = new DB;
            $vehiculo = $db::select('select a.vehiculo_id, a.placa, a.modelo, a.marca, a.color from vehiculos a, conductores b, conductor_vehiculo c 
            where a.vehiculo_id = ?
            and b.conductor_id = ?
            and c.vehiculo_id = a.vehiculo_id
            and c.conductor_id = b.conductor_id', [$vehiculo_id,$conductor_id]);
            if($vehiculo){
                return response()->json($vehiculo[0],200);
            }
            return response()->json([
                'message' => 'Vehicle not found',
                'code' => 404,
            ]);
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
            $db = new DB;
            $vehiculos = $db::select('select a.vehiculo_id, a.placa, a.modelo, a.marca, a.color from vehiculos a, conductores b, conductor_vehiculo c 
            where b.conductor_id = ?
            and b.conductor_id = c.conductor_id 
            and a.vehiculo_id = c.vehiculo_id', [$conductor_id]);
            if($vehiculos){
                return response()->json($vehiculos,200);
            }
            return response()->json([
                'message' => 'No Vehicles',
                'code' => 404,
            ]);
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