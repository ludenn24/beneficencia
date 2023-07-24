<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portada extends Model
{
    protected $table = 'tb_portadas';

    protected $fillable = [
        'codigo',
        'nombre',
        'foto',
        'link',
        'inicio',
        'fin',
        'estado',
        'created_at',
        'updated_at'
    ];
}
