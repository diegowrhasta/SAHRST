<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';
    protected $primaryKey = 'reporte_id';

    protected $fillable = [
        'conductor_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
