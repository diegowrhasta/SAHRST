<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductor';
    protected $primaryKey ='conductor_id';
    protected $softDelete = true;

    protected $fillable = [
        'nombres', 'ap_paterno', 'ap_materno', 'fecha_nacimiento', 'ci', 'direccion', 'celular', 'telefono'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
