<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use SoftDeletes;
    
    protected $table = 'vehiculos';
    protected $primaryKey = 'vehiculo_id';
    protected $softDelete = true;

    protected $fillable = [
        'placa', 'modelo', 'marca', 'color'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];

    public function conductor_vehiculo(){
        return $this->hasMany('App\Conductor_Vehiculo', 'vehiculo_id', 'vehiculo_id');
    }
}
