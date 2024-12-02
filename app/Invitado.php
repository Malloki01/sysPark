<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    // Variables : dni, nombres, apellidos, correo, teléfono, nro_placa, tipo
    protected $table = 'invitados';
    protected $fillable = ['dni', 'nombres', 'apellidos','correo','telefono','nro_placa', 'tipo','estado'];
}