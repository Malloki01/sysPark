<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;


use Livewire\Component;
use App\Registro;
use App\Cliente;

class RegistrosController extends Component
{
    public $dni_placa;
    public $usuario = null; // Información del usuario validado
    public $registro; // Registro de entrada o salida del usuario
    public $tipo_operacion = 'entrada'; // Puede ser 'entrada' o 'salida'

    public function render()
    {
        // Condicionar según el tipo de operación: "entrada" o "salida"
        if ($this->tipo_operacion === 'entrada') {
            return view('livewire.entradas.component', [
                // Puedes pasar variables adicionales si es necesario
            ]);
        } elseif ($this->tipo_operacion === 'salida') {
            return view('livewire.salidas.component', [
                // Puedes pasar variables adicionales si es necesario
            ]);
        }
    }

    // Consultar si el usuario está registrado para entrada
    public function validarUsuario()
    {
        //Validar dni_placa
        $this->validate([
            'dni_placa' => 'required',
        ]);
        // Buscar el usuario por DNI o número de placa
        $this->usuario = Cliente::where('dni', $this->dni_placa)
            ->orWhere('nro_placa', $this->dni_placa)
            ->first();

        if (!$this->usuario) {
            session()->flash('error', 'Usuario no encontrado');
        } else {
            session()->flash('message', 'Usuario validado correctamente');
        }
    }
     // Consultar si el usuario está registrado para salida
    public function validarUsuarioSalida()
    {
        //Validar dni_placa
        $this->validate([
            'dni_placa' => 'required',
        ]);
        // Buscar el usuario por DNI o número de placa
        $this->usuario = Cliente::where('dni', $this->dni_placa)
            ->orWhere('nro_placa', $this->dni_placa)
            ->first();

        if (!$this->usuario) {
            session()->flash('error', 'Usuario no encontrado');
        } else {
            // Buscar el registro de entrada del usuario
            $this->registro = Registro::where('dni', $this->usuario->dni)
                ->whereNull('hora_salida')
                ->latest()
                ->first();

            if (!$this->registro) {
                session()->flash('error', 'No se encontró un registro de entrada para este usuario');
            } else {
                session()->flash('message', 'Usuario validado correctamente');
            }
        }
    }

    // Guardar el registro de entrada
    public function guardarEntrada()
    {
         // Validar si el usuario está seleccionado
    if (!$this->usuario) {
        $this->addError('dni_placa', 'Debe validar un usuario antes de guardar.');
        return;
    }

    // Guardar la entrada si el usuario fue validado
    Registro::create([
        'dni' => $this->usuario->dni,
        'placa_vehiculo' => $this->usuario->nro_placa?? null,
        'tipo' => $this->usuario->tipo,
        'hora_entrada' => now(),
        'fecha' => now()->format('Y-m-d'),
    ]);

    session()->flash('message', 'Entrada registrada exitosamente');
    $this->resetInput();
    }

    // Guardar el registro de salida
    public function guardarSalida()
    {
        if ($this->registro) {
            $this->registro->hora_salida = now();
            $this->registro->save();

            session()->flash('message', 'Salida registrada exitosamente');
            $this->resetInput();
        }
    }

    // Resetear los campos del formulario
    public function resetInput()
    {
        $this->dni_placa = '';
        $this->usuario = null;
        $this->registro = null;
    }

    // Escuchar los eventos de Livewire
    protected $listeners = ['guardarEntrada', 'guardarSalida'];
}
