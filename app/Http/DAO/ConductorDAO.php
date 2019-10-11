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
            $img = Image::make(file_get_contents(public_path('/uploads/avatars/'. $avatar)));
            return response($img)->header('Content-type','image/jpg');
        }
        catch(\Exception $exception){
            return response()->json([
                'Message'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        }
    }
    public function dbGetConductorNextPuntoControl($conductor_id){
        try{
            $next_punto_control = DB::select('select a.punto_id,a.nombre from puntos a, puntos_ruta b, rutas c, conductores d, tipo_puntos e
            where a.tipo_punto_id=2
            and c.ruta_id = b.ruta_id
            and a.punto_id = b.punto_id
            and c.ruta_id = d.ruta_id
            and d.conductor_id = ?
            and a.punto_id = d.next_punto_control
            and e.tipo_punto_id=a.tipo_punto_id;', [$conductor_id]);
            return $next_punto_control;
        } catch (QueryException $exception){
            return false;
        } catch (\Exception $exception){
            return false;
        }   
    }
    public function dbAdvanceCheckpoint($conductor_id){
        try{
            $allGood = false;
            $theNextCheckpoint = 0;
            $getCurrentCheckpoint = (array)$this->dbGetConductorNextPuntoControl($conductor_id);
            $puntosControlFromConductor = (array) DB::select('select a.punto_id from puntos a, puntos_ruta b, rutas c, conductores d, tipo_puntos e
            where a.tipo_punto_id=2
            and c.ruta_id = b.ruta_id
            and a.punto_id = b.punto_id
            and c.ruta_id = d.ruta_id
            and d.conductor_id = ?
            and e.tipo_punto_id=a.tipo_punto_id
            order by b.posicion', [$conductor_id]);
            $dasObject = $getCurrentCheckpoint[0];
            for($i = 0; $i<sizeof($puntosControlFromConductor); $i++){
                $object_i = $puntosControlFromConductor[$i];
                if($i==(sizeof($puntosControlFromConductor)-1) && $object_i->punto_id==$dasObject->punto_id){
                    DB::update('update conductores set next_punto_control = null 
                    where conductor_id = ?', [$conductor_id]);
                    $allGood = true;
                    break;
                }
                else{
                    if($object_i->punto_id==$dasObject->punto_id){
                        DB::update('update conductores set next_punto_control = ? 
                        where conductor_id = ?', [($object_i->punto_id+1),$conductor_id]);
                        $allGood = true;
                        $theNextCheckpoint = $object_i->punto_id+1;
                        break;
                    }
                }
            }
            if($allGood){
                return response()->json([
                    'message' => 'Punto de Control avanzado',
                    'next_punto' => $theNextCheckpoint,
                    'code' => 202,
                ]);
            }
            else{
                return response()->json([
                    'message' => 'Error al subir punto de control',
                    'code' => 400,
                ]);
            }
        } catch (QueryException $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 400);
        } catch (\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
            ], 500);
        }
    }
}