<?php
namespace App\Http\DAO;

use App\Tipo_Punto;
use Illuminate\Database\QueryException;

class Tipo_PuntoDAO
{
    public function dbSaveTipo_Punto(array $data)
    {
        try{
            Tipo_Punto::create($data);
            return response()->json([
                'message' => 'Tipo_Punto registrado correctamente',
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
    public function getTipo_Punto($tipo_punto_id){
        try{
            $tipo_punto = Tipo_Punto::find($tipo_punto_id);
            return $tipo_punto;
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'Tipo_Punto not found',
                'code' => 404,
            ],404);
        }
    }
    public function getList(){
        try{
            $tipos_punto = Tipo_Punto::all();
            return $tipos_punto;
        }
        catch(\Exception $e){
            return false;
        }
    }
}