<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSeccion extends Model
{
    protected $table = 'tb_sub_secciones';

    protected $fillable = [
        'codigo',
        'id_seccion',
        'nombre',
        'url',
        'estado'
    ];
}
