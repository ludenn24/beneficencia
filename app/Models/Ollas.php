<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ollas extends Model
{

    protected $table = 'tb_ollas_excel';

    protected $fillable = [
        'id',
        'correo',
        'distrito',
        'zona',
        'aahh',
        'ubicacion',
        'agua',
        'luz',
        'nombre_olla',
        'nombre_contacto',
        'cargo_contacto',
        'celular_contacto',
        'presencia_muni',
        'insumos',
        'org_ayuda',
        'instrumentos',
        'dias_atencion',
        'comidas_dia',
        'raciones',
        'precio_racion',
        'raciones_pagadas',
        'zonas_beneficiadas',
        'familias_beneficiadas',
        'ninos_beneficiadas',
        'adultos_beneficiadas',
        'disca_beneficiadas',
        'emba_beneficiadas',
        'enfercro_beneficiadas',
        'observaciones',
        'total_beneficiadas',
        'foto',
        'latitud',
        'longitud',
        'estado'

    ];

}