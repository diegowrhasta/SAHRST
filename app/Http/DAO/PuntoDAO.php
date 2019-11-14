<?php
namespace App\Http\DAO;

use App\Punto;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PuntoDAO
{
    public function dbSavePunto(array $data)
    {
        try{
            $punto = new Punto;
            $punto::create($data);
            return response()->json([
                'message' => 'Punto registrado correctamente',
                'code' => 201,
            ],201);
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
    public function dbGetPunto($punto_id){
        try{
            $punto = new Punto;
            $punto = $punto::find($punto_id);
            return $punto;
        }   
        catch(\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
    public function dbGetPuntos(){
        try{
            $puntos = new Punto;
            $puntos::all();
            return $puntos;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbGetPuntosControlFromConductor($conductor_id){
        try{
            $db = new DB;
            $puntosControlFromConductor = (array) $db::select('select a.punto_id from puntos a, puntos_ruta b, rutas c, conductores d, tipo_puntos e
            where a.tipo_punto_id=2
            and c.ruta_id = b.ruta_id
            and a.punto_id = b.punto_id
            and c.ruta_id = d.ruta_id
            and d.conductor_id = ?
            and e.tipo_punto_id=a.tipo_punto_id
            order by b.posicion', [$conductor_id]);
            return $puntosControlFromConductor;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
}