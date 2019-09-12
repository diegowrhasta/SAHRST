<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Punto extends Model
{
    use SoftDeletes;
    protected $table = 'puntos';
    protected $primaryKey ='punto_id';
    protected $softDelete = true;
    
    protected $fillable = [
        'nombre','tipo_punto_id'
    ];
    
    protected $hidden = [
        'created_at','deleted_at','updated_at',
    ];
    public function tipo_punto(){
        return $this->belongsTo('App\Tipo_Punto','tipo_punto_id','tipo_punto_id');
    }
    public function punto_ruta(){
        return $this->hasMany('App\Punto_Ruta','punto_id','punto_id');
    }
}
