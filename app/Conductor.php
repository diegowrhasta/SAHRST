<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductor';
    protected $primaryKey ='conductor_id';
    protected $softDelete = true;

    protected $fillable = [
        'nombres', 'ap_paterno', 'ap_materno', 'fecha_nacimiento', 'ci', 'direccion', 'celular', 'telefono', 'ruta_id'
    ];
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];
}