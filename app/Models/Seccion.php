<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = 'tb_secciones';

    protected $fillable = [
        'codigo',
        'nombre',
        'url',
        'estado',
    ];
}
