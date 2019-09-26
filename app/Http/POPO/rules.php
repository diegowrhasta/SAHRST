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
}