<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $table = 'tb_multimedia';

    protected $fillable = [
        'codigo',
        'archivo',
        'url',
        'estado',
        'created_at',
        'updated_at',
    ];
}
