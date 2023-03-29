<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{

    protected $table = 'tb_mesa';

    protected $fillable = [
        'codigo',
        'categoria',
        'tipo_persona',
        'natural_tipo_doc',
        'natural_dni',
        'natural_nombres',
        'natural_apellidos',
        'natural_departamento',
        'natural_provincia',
        'natural_distrito',
        'natural_direccion',
        'juridico_ruc',
        'juridico_nombre_empresa',
        'juridico_departamento',
        'juridico_provincia',
        'juridico_distrito',
        'juridico_direccion',
        'juridico_tipo_doc_rep',
        'juridico_dni_rep',
        'juridico_nombre_rep',
        'juridico_ape_rep',
        'correo',
        'telefono',
        'motivo',
        'mensaje',
        'archivo',
        'estado',
        'observacion',
        'created_at',

    ];

}