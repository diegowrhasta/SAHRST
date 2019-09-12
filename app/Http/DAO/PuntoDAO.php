<?php
namespace App\Http\DAO;

use App\Punto;
use Illuminate\Database\QueryException;

class PuntoDAO
{
    public function dbSavePunto(array $data)
    {
        try{
            Punto::create($data);
            return response()->json(['status'=>'Punto registrado correctamente'],200);
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