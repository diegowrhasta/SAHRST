<?php
/**
 * Created by PhpStorm.
 * User: Yawar
 * Date: 10/9/2019
 * Time: 23:42
 */

namespace App\Http\DAO;


use App\Conductor;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Image;
class ConductorDAO
{

    public function dbSaveConductor(array $data)
    {
        try{
            Conductor::create($data);
            return response()->json(['status'=>'Conductor registrado correctamente'],200);
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
    public function getConductor($conductor_id){
        try{
            $conductor = Conductor::find($conductor_id);
            return $conductor;
        }
        catch(\Exception $e){
            return false;
        }
    }
    public function getList(){
        try{
            $conductores = Conductor::all();
            return $conductores;
        }
        catch(\Exception $e){
            return false;
        }
    }
    public function dbDeleteConductor($conductor_id){
        try{
            Conductor::destroy($conductor_id);
            return true;
        }
        catch(\Exception $exception){
            return false;
        }
    }
    public function dbEditConductor($conductor_old){
        try{
            $conductor_old->save();
            return true;
        }
        catch(\Exception $exception){
            return false;
        }
    }
    public function UploadProfilePic($avatar,$filename){ //Found the final form for responses
        try{
            $path = public_path('/uploads/avatars/' . $filename);
            Image::make($avatar->getRealPath())->resize(300, 300)->save($path);
            return response()->json([
                'Message'=> 'Subida Exitosa',
                'Code'=>202,
            ], 202);
        }
        catch(\Exception $exception){
            return response()->json([
                'Message'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
    public function retrieveProfilePic($avatar){
        try{
            $img = Image::make(file_get_contents(public_path('/uploads/avatars/' . $avatar )));
            return $img;
        }
        catch(\Exception $exception){
            return false;
        }
    }
    public function dbGetConductorNextPuntoControl($conductor_id){
        try{
            $next_punto_control = DB::select('select a.nombre from puntos a, puntos_ruta b, rutas c, conductores d, tipo_puntos e
            where a.tipo_punto_id=2
            and c.ruta_id = b.ruta_id
            and a.punto_id = b.punto_id
            and c.ruta_id = d.ruta_id
            and d.conductor_id = ?
            and a.punto_id = d.next_punto_control
            and e.tipo_punto_id=a.tipo_punto_id;', [$conductor_id]);
            return response()->json($next_punto_control,200);
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