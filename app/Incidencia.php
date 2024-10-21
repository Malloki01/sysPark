<?php
// REGISTRAR LAS INCIDENCIAS DEL ESTACIONAMIENTO
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $table = 'incidencias';
    protected $fillable = ['titulo','descripcion'];

    //protected $rules = ['descripcion' => 'required|min:4'];
}
