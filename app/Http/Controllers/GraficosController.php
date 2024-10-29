<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GraficosController extends Controller
{

    public function obtenerDatos()
    {
        try {
            // Obtener los datos de la tabla 'registro'
            $registros = Registro::selectRaw('HOUR(hora_entrada) as hora, tipo, COUNT(*) as cantidad')
                // ->whereDate('fecha', Carbon::today()) // Filtrar por la fecha de hoy
                ->groupBy('hora', 'tipo')
                ->get();

            // Verifica que se están obteniendo los datos correctamente
            if ($registros->isEmpty()) {
                Log::info("No se encontraron registros en la tabla.");
            } else {
                Log::info("Registros obtenidos: ", $registros->toArray());
            }

            // Formatear los datos para Google Charts
            $data = [['Hora', 'Carros', 'Bicicletas']];
            $horas = range(0, 23);
            $tipos = ['carro', 'bicicleta'];

            foreach ($horas as $hora) {
                $fila = [sprintf('%02d:00', $hora), 0, 0];
                foreach ($tipos as $index => $tipo) {
                    // Filtrar registros solo para la hora actual y tipo actual
                    $registrosHora = $registros->where('hora', $hora);

                    // Comprobar que $registrosHora no esté vacío
                    if ($registrosHora->isNotEmpty()) {
                        $registro = $registrosHora->firstWhere('tipo', $tipo);
                        if ($registro) {
                            $fila[$index + 1] = $registro->cantidad;
                        }
                    }
                }
                $data[] = $fila;
            }

            Log::info("Datos formateados para el gráfico: ", $data);

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error("Error en obtenerDatos: " . $e->getMessage());
            return response()->json(['error' => 'Error al obtener los datos'], 500);
        }
    }
}