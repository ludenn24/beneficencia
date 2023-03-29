<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'tb_noticias';

    protected $fillable = [
        'codigo',
        'categoria',
        'titular',
        'foto',
        'detalle',
        'estado',
        'detallemin',
        'created_at',
    ];
}
