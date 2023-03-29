<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    protected $table = 'tb_pagina';

    protected $fillable = [
        'codigo',
        'nombre',
        'detalle',
        'portada',
        'title',
        'url_canonica',
        'descripcion',
        'keywords',
        'estado'
    ];
}
