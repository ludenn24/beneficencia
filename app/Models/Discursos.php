<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discursos extends Model
{
    protected $table = 'tb_discursos';

    protected $fillable = [
        'codigo',
        'titular',
        'foto',
        'detalle',
        'estado',
        'detallemin',
        'created_at',
    ];
}
