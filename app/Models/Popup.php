<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $table = 'tb_pop_up';

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
