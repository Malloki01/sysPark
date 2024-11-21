<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Variables : dni, nombres, apellidos, nro_placa, tipo
    protected $table = 'clientes';
    protected $fillable = ['dni', 'nombres', 'apellidos', 'nro_placa', 'tipo', 'correo', 'telefono'];    
}
