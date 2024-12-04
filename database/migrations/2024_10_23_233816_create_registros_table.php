<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            // Variables : dni, placa_vehiculo, tipo, hora_entrada, hora_salida, fecha
            $table->id();//Id_Registro
            $table->string('dni', 8); // DNI
            $table->string('placa_vehiculo')->nullable(); // Placa Vehiculo
            $table->string('tipo'); // Tipo
            $table->timestamp('hora_entrada'); // Hora Entrada
            $table->timestamp('hora_salida')->nullable(); // Hora Salida
            $table->date('fecha'); // Fecha 
            $table->timestamps();

            // Foreign Key
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
