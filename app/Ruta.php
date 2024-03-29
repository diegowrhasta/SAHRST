<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use SoftDeletes;

    protected $table = 'rutas';
    protected $primaryKey ='ruta_id';
    protected $softDelete = true;
    
    protected $fillable = [
        'nombre'
    ];
    
    protected $hidden = [
        'created_at','deleted_at','updated_at',
    ];
    public function conductor(){
        return $this->hasMany('App\Conductor','ruta_id','ruta_id');
    }
    public function punto_ruta(){
        return $this->hasMany('App\Punto_Ruta','ruta_id','ruta_id');
    }

}
