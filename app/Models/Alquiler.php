<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    protected $table = 'tb_inmobiliaria';

    protected $fillable = [
        'codigo',
        'condicion',
        'distrito',
        'area',
        'tipo_uso',
        'modalidad',
        'numero',
        'nombre',
        'precio',
        'moneda',
        'latitud',
        'longitud',
        'foto',
        'estado',
    ];
}
