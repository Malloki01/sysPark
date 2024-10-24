<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    // Variables : dni, placa_vehiculo, tipo, hora_entrada, hora_salida, fecha 
    protected $table = 'registros';
    protected $fillable = ['hora_entrada', 'hora_salida', 'fecha', 'placa_vehiculo', 'dni','tipo'];
}
