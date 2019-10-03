<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor_Vehiculo extends Model
{
    protected $table = 'conductor_vehiculo';
    protected $primaryKey = 'conductor_vehiculo_id';

    protected $fillable = [
        'conductor_id', 'vehiculo_id'
    ];
    
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];

    public function conductor(){
        return $this->belongsTo('App\Conductor','conductor_id','conductor_id');
    }

    public function vehiculo(){
        return $this->belongsTo('App\Vehiculo','vehiculo_id','vehiculo_id');
    }
}
