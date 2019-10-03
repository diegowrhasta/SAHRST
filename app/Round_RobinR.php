<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round_RobinR extends Model
{
    protected $table = 'round_robinr';
    protected $primaryKey = 'round_robin_id';

    protected $fillable = [
        'next_ruta_id'
    ];
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];
}
