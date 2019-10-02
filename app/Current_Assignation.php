<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Current_Assignation extends Model
{
    protected $table = 'current_assignation';
    protected $primaryKey = 'current_id';

    protected $fillable = [
        'current_conductor_id'
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];
}
