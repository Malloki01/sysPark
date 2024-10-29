<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Registro;

class DisponibilidadController extends Component
{
    public $capacidad = [
        'carro' => 10,
        'moto' => 10,
        'scooter' => 10,
        'bicicleta' => 10, // Capacidad limitada
    ];
    
    public $disponibilidad = [];

    public function mount()
    {
        $this->calcularDisponibilidad();
    }

    public function calcularDisponibilidad()
    {
        $ocupadosCarro = Registro::where('tipo', 'carro')->whereNull('hora_salida')->count();
        $ocupadosMoto = Registro::where('tipo', 'moto')->whereNull('hora_salida')->count();
        $ocupadosScooter = Registro::where('tipo', 'scooter')->whereNull('hora_salida')->count();
        $ocupadosBicicleta = Registro::where('tipo', 'bicicleta')->whereNull('hora_salida')->count();

        // Calcular la disponibilidad restante
        $this->disponibilidad = [
            'carro' => max(0, $this->capacidad['carro'] - $ocupadosCarro),
            'moto' => max(0, $this->capacidad['moto'] - $ocupadosMoto),
            'scooter' => max(0, $this->capacidad['scooter'] - $ocupadosScooter),
            'bicicleta' => max(0, $this->capacidad['bicicleta'] - $ocupadosBicicleta),
        ];

        // dd($this->disponibilidad);
    }

    public function render()
    {
        return view('livewire.disponibilidad.component');
    }
}
