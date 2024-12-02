<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitados', function (Blueprint $table) 
        {
             // Variables : dni, nombres, apellidos, correo, teléfono, nro_placa, tipo
            $table->id();
            $table->string('dni')->unique(); // DNI del usuario
            $table->string('nombres'); // Nombres del usuario
            $table->string('apellidos'); // Apellidos del usuario
            $table->string('nro_placa')->nullable(); // Número de placa (puede ser nulo)
            $table->string('correo')->unique(); // Correo del usuario
            $table->string('telefono'); // Teléfono del usuario
            $table->string('tipo'); // Tipo de vehículo
            $table->string('estado'); // Estado del usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitados');
    }
}
