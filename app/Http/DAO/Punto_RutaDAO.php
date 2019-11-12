<?php
namespace App\Http\DAO;

use App\Punto_Ruta;
use Illuminate\Database\QueryException;

class Punto_RutaDAO
{
    public function dbSavePunto_Ruta(array $data)
    {
        try{
            Punto_Ruta::create($data);
            return response()->json([
                'message' =>'Punto_Ruta registrado correctamente',
                'code' => 201
            ],201);
        } catch (QueryException $exception){
            return response()->json([
                'Error'=> 'Error interno del servidor',
            ], 500);
        } catch (\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbGetPuntos_Ruta(){
        try{
            $puntos_ruta = Punto_Ruta::all();
            return $puntos_ruta;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbDestroyPuntoRuta($puntos_ruta_id){
        try{
            Punto_Ruta::destroy($puntos_ruta_id);
            return response()->json([
                'message' =>'Relación eliminada',
                'code' => 201
            ],201);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400); 
        }
    }
}