<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_Punto extends Model
{
    use SoftDeletes;
    protected $table = 'tipo_puntos';
    protected $primaryKey ='tipo_punto_id';
    protected $softDelete = true;
    
    protected $fillable = [
        'nombre'
    ];
    
    protected $hidden = [
        'created_at','deleted_at','updated_at',
    ];
    public function punto(){
        return $this->hasMany('App\Punto','tipo_punto_id','tipo_punto_id');
    }
}
