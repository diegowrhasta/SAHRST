<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use SoftDeletes;

    protected $table = 'conductores';
    protected $primaryKey ='conductor_id';
    protected $softDelete = true;

    protected $fillable = [
        'nombres', 'ap_paterno', 'ap_materno', 'fecha_nacimiento', 'ci', 'direccion', 'celular', 'telefono', 'ruta_id'
    ];
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];
    public function ruta(){
        return $this->belongsTo('App\Ruta','ruta_id','ruta_id');
    }
}