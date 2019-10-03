<?php
namespace App\Http\DAO;

use App\Round_Robinr;
use App\Ruta;
use Illuminate\Database\QueryException;

class RutaDAO
{
    public function dbSaveRuta(array $data)
    {
        try{
            Ruta::create($data);
            return response()->json(['status'=>'Ruta registrada correctamente'],200);
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
            return $ruta;
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
            ], 400);
        }
    }
}