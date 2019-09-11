<?php
namespace App\Http\DAO;

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
    
}