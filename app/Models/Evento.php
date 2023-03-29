<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'tb_eventos';

    protected $fillable = [
        'codigo',
        'categoria',
        'nombre',
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'detalle',
        'foto',
        'estado',
    ];
}
