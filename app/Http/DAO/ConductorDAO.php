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
            return response()->json([
                'message'=>'Conductor registrado correctamente',
                'code' => 201,
            ],201);
        } catch (QueryException $exception){
            return response()->json([
                'message'=> 'Error interno del servidor',
                'code' => 500,
            ], 500);
        } catch (\Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage(),
                'code'=>$exception->getCode(),
            ], $exception->getCode());
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
            return response()->json([
                'message' => 'Eliminación exitosa',
                'code' => 202,
            ],202);
        }
        catch(\Exception $exception){
            return response()->json([
                'Error' => $exception->getMessage(),
                'Code' => $exception->getCode(),
                'Error_Line' => $exception->getLine(),
            ], 500);
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
            return response()->json([
                'message' => 'image not found',
                'code' => 404,
            ],404);
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
    public function dbAdvanceCheckpoint($conductor_id){
        try{
            $allGood = false;
            $finishedControls = false;
            $theNextCheckpoint = 0;
            $getCurrentCheckpoint = (array)$this->dbGetConductorNextPuntoControl($conductor_id);
            $puntosControlFromConductor = (array) DB::select('select a.punto_id,a.nombre from puntos a, puntos_ruta b, rutas c, conductores d, tipo_puntos e
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
                    $finishedControls = true;
                    break;
                }
                else{
                    if($object_i->punto_id==$dasObject->punto_id){
                        DB::update('update conductores set next_punto_control = ? 
                        where conductor_id = ?', [($puntosControlFromConductor[$i+1]->punto_id),$conductor_id]);
                        $allGood = true;
                        $theNextCheckpoint = $puntosControlFromConductor[$i+1];
                        break;
                    }
                }
            }
            if($finishedControls){
                return response()->json([
                    'message' => 'Último Punto de Control avanzado',
                    'code' => 202,
                ],202);
            }
            if($allGood){
                return response()->json([
                    'message' => 'Punto de Control avanzado',
                    'next_punto_id' => $theNextCheckpoint -> punto_id,
                    'nombre_next_punto' => $theNextCheckpoint -> nombre,
                    'code' => 202,
                ],202);
            }
            else{
                return response()->json([
                    'message' => 'Error al avanzar punto de control',
                    'code' => 400,
                ],400);
            }
        } catch (QueryException $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
                'Error_Line'=>$exception->getLine(),
            ], 400);
        } catch (\Exception $exception){
            return response()->json([
                'Error'=> $exception->getMessage(),
                'Code'=>$exception->getCode(),
                'Error_Line'=>$exception->getLine(),
            ], 500);
        }
    }
}