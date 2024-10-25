<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Registro;

class DisponibilidadController extends Component
{
    public $capacidad = [
        'automovil' => 10,
        'moto' => 8,
        'scooter' => 2,
        'bicicleta' => 0, // Capacidad limitada
    ];
    public $disponibilidad = [];

    public function mount()
    {
        $this->calcularDisponibilidad();
    }

    public function calcularDisponibilidad()
    {
        $ocupadosAutomovil = Registro::where('tipo', 'automovil')->whereNull('hora_salida')->count();
        $ocupadosMoto = Registro::where('tipo', 'moto')->whereNull('hora_salida')->count();
        $ocupadosScooter = Registro::where('tipo', 'scooter')->whereNull('hora_salida')->count();
        $ocupadosBicicleta = Registro::where('tipo', 'bicicleta')->whereNull('hora_salida')->count();

        // Calcular la disponibilidad restante
        $this->disponibilidad = [
            'automovil' => max(0, $this->capacidad['automovil'] - $ocupadosAutomovil),
            'moto' => max(0, $this->capacidad['moto'] - $ocupadosMoto),
            'scooter' => max(0, $this->capacidad['scooter'] - $ocupadosScooter),
            'bicicleta' => max(0, $this->capacidad['bicicleta'] - $ocupadosBicicleta),
        ];
    }

    public function render()
    {
        return view('livewire.disponibilidad');
    }
}
