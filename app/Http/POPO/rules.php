<?php

namespace App\Http\POPO;

class rules{
    public function rulesConductor(){
        return $rules = [
            'nombres'=>'required|max:45|string',
            'ap_paterno'=>'required|max:25|string',
            'ap_materno'=>'required|max:25|string',
            'fecha_nacimiento'=>'required|date',
            'ci'=>'required|numeric',
            'direccion'=>'required|string',
            'celular'=>'required|numeric',
            'telefono'=>'numeric',
        ];
    }
    public function rulesVehiculo(){
        return $rules = [
            'placa'=>'required|max:10|string',
            'modelo'=>'required|int',
            'marca'=>'required|max:50|string',
            'color'=>'required|max:15|string',
        ];
    }
    public function rulesConductor_Vehiculo(){
        return $rules = [
            'conductor_id'=>'required|int',
            'vehiculo_id'=>'required|int',
        ];
    }
}