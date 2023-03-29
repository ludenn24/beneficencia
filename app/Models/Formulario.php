<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{

    protected $table = 'tb_formulario';

    protected $fillable = [
                               'codigo',
		  'categoria',
		  'nombres',
		  'apellidos',
		  'dni',
		  'correo',
		  'telefono',
		  'direccion',
		  'motivo',
		  'mensaje',
		  'tipodonacion',
		  'tiempovoluntario',
                                'estado',
                                'observacion',
                                'created_at',

    ];

}