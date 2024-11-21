<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->unique(); // DNI del usuario
            $table->string('nombres'); // Nombres del usuario
            $table->string('apellidos'); // Apellidos del usuario
            $table->string('nro_placa')->nullable(); // Número de placa (puede ser nulo)
            $table->string('tipo'); // Tipo de vehículo
            $table->string('correo')->nullable(); // Correo electrónico (puede ser nulo)
            $table->string('telefono')->nullable(); // Teléfono (puede ser nulo)
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
        Schema::dropIfExists('clientes');
    }
}
