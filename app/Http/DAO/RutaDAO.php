<?php
namespace App\Http\DAO;

use App\Round_Robinr;
use App\Ruta;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RutaDAO
{
    public function dbSaveRuta(array $data)
    {
        try{
            Ruta::create($data);
            return response()->json([
                'message' => 'Ruta registrada correctamente',
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
    public function dbGetRutas(){
        try{
            $rutas = Ruta::all();
            return $rutas;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbGetRoute($ruta_id){
        try{
            $ruta = Ruta::find($ruta_id);
            return $ruta;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function retrieveNextRoute(){
        try{
            $ruta = Round_Robinr::get('next_ruta_id');
            return $ruta->toArray();
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbUpdateRoute($ruta){
        try{
            $ruta->save();
            return response()->json([
                'message' => 'Ruta Updated',
                'code' => 201,
            ], 201);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function updateNextRoute($updatedValue){
        try{
            DB::update('update round_robinr set next_ruta_id = ? where round_robin_id = 1', [$updatedValue]);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbRutaDestroy($ruta_id){
        try{
            Ruta::destroy($ruta_id);
            return response()->json([
                'message' => 'Ruta Deleted',
                'code' => 201,
            ], 201);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
    public function dbGetRoutePoints($ruta_id){
        try{
            $points = (array)DB::select('select a.ruta_id,a.punto_id,c.nombre as nombre_punto, d.nombre as tipo_punto 
            from puntos_ruta a, rutas b, puntos c, tipo_puntos d
            where a.ruta_id=?
            and b.ruta_id=?
            and a.deleted_at IS NULL
            and c.punto_id=a.punto_id
            and c.tipo_punto_id=d.tipo_punto_id
            order by a.posicion ASC;', [$ruta_id,$ruta_id]);
            return $points;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
}