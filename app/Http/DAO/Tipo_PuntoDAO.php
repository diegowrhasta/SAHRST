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
}