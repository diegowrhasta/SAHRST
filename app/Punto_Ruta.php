<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Punto_Ruta extends Model
{
    use SoftDeletes;
    protected $table = 'puntos_ruta';
    protected $primaryKey ='punto_ruta_id';
    protected $softDelete = true;
    
    protected $fillable = [
        'punto_id','ruta_id'
    ];
    
    protected $hidden = [
        'created_at','deleted_at','updated_at',
    ];
    public function punto(){
        return $this->belongsTo('App\Punto','punto_id','punto_id');
    }
    public function ruta(){
        return $this->belongsTo('App\Ruta','ruta_id','ruta_id');
    }
}
