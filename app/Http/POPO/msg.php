<?php

namespace App\Http\POPO;

class msg{
    public function messagesConductor(){
        return $msg = [
            'nombres.required'=>'El campo nombre es requerido',
            'nombres.max'=>'El campo nombre debe tener como máximo 45 caracteres',
            'nombres.string'=>'Campo nombre inválido',
            'ap_paterno.required'=>'El campo para apellido paterno es requerido',
            'ap_paterno.max'=>'El campo para apellido paterno debe tener como máximo 25 caracteres',
            'ap_materno.required'=>'El campo para apellido materno es requerido',
            'ap_materno.max'=>'El campo para apellido materno debe tener como máximo 25 caracteres',
            'fecha_nacimiento.date'=>'Formato de fecha es incorrecto',
            'ci.required'=>'Número de identificación requerido',
            'ci.numeric'=>'El campo CI debe ser de tipo numérico',
            'direccion.required'=>'La dirección es requerida',
            'celular.required'=>'El número de celular es requerido',
            'celular.numeric'=>'El número de celular debe ser numérico',
            'telefono.numeric'=>'El número de telef debe ser numérico',
        ];
    }
    public function messagesVehiculo(){
        return $msg = [
            'placa.required'=>'El campo de placa es requerido',
            'placa.max'=>'El campo placa debe tener como máximo 15 caracteres',
            'placa.string'=>'Campo placa inválido',
            'modelo.required'=>'El campo modelo es requerido',
            'modelo.int'=>'El campo modelo debe ser un entero',
            'marca.required'=>'El campo de marca es requerido',
            'marca.max'=>'El campo marca debe tener como máximo 50 caracteres',
            'marca.string'=>'Campo marca inválido',
            'color.required'=>'El campo de color es requerido',
            'color.max'=>'El campo color debe tener como máximo 15 caracteres',
            'color.string'=>'Campo color inválido',
        ];
    }
}