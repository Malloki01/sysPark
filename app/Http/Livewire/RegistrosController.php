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
    public $estado_consulta = false;//estado de la consulta

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
        // Buscar en el registro de entrada si el usuario ya está dentro
        $this->registro = Registro::where(function ($query) 
        {
            //agrupar las condiciones
            $query->where('dni', $this->dni_placa)
                ->orWhere('placa_vehiculo', $this->dni_placa);
        })
            ->whereNull('hora_salida')
            ->latest()
            ->first();

        if ($this->registro) {
            session()->flash('error', 'El usuario ya se encuentra dentro');
            $this->estado_consulta = false; // Consulta fallida
            return;
        }

        // Buscar el usuario por DNI o número de placa
        $this->usuario = Cliente::where('dni', $this->dni_placa)
            ->orWhere('nro_placa', $this->dni_placa)
            ->first();

        if (!$this->usuario) {
            session()->flash('error', 'Usuario no encontrado');
            $this->estado_consulta = false; // Consulta fallida
        } else {
            session()->flash('message', 'Usuario validado correctamente');
            $this->estado_consulta = true; // Consulta exitosa
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
        $this->usuario = Registro::where(function ($query) 
        {
            //agrupar las condiciones
            $query->where('dni', $this->dni_placa)
                ->orWhere('placa_vehiculo', $this->dni_placa);
        })
            ->whereNull('hora_salida')
            ->latest()
            ->first();

        if (!$this->usuario) {
            session()->flash('error', 'Usuario no encontrado o no registrado');
            $this->estado_consulta = false; // Consulta fallida
        } else {
            // Buscar el registro de entrada del usuario
            $this->registro = Registro::where('registros.dni', $this->usuario->dni)
                ->orWhere('registros.placa_vehiculo', $this->usuario->placa_vehiculo)
                ->join('clientes as cli', 'registros.dni', '=', 'cli.dni')
                ->select('registros.*', 'cli.nombres', 'cli.apellidos', 'cli.nro_placa')
                ->latest()
                ->first();
        
            if (!$this->registro) {
                session()->flash('error', 'No se encontró un registro de entrada para este usuario');
                 $this->estado_consulta = false; // Consulta fallida
            } else {
                session()->flash('message', 'Usuario validado correctamente');
                $this->estado_consulta = true; // Consulta exitosa
            }
        }

    }

    // Guardar el registro de entrada
    public function guardarEntrada()
    {
        // Validar si el usuario está seleccionado
        if (!$this->usuario) {
            session()->flash('error', 'Usuario no validado');
            return;
        }

        // Buscar en el registro de entrada si el usuario ya está dentro
        if ($this->registro) {
            session()->flash('error', 'El usuario ya se encuentra dentro');
            return;
        }

        // Guardar la entrada si el usuario fue validado
        Registro::create([
            'dni' => $this->usuario->dni,
            'placa_vehiculo' => $this->usuario->nro_placa ?? null,
            'tipo' => $this->usuario->tipo,
            'hora_entrada' => now(),
            'fecha' => now()->format('Y-m-d'),
        ]);
        session()->flash('message', 'Entrada registrada exitosamente');
        $this->emit('actualizarDisponibilidad');

        $this->resetInput();
    }

    // Guardar el registro de salida
    public function guardarSalida()
    {

        if ($this->registro) {
            //Realizar una consulta nueva en registro guardar el ultimo  id de registro de entrada y lo actualiza
            $registro = Registro::where('dni', $this->registro->dni)
                ->whereNull('hora_salida')
                ->update([
                    'hora_salida' => now(),
                ]);


            // Guardar la salida si el registro de entrada fue encontrado


            session()->flash('message', 'Salida registrada exitosamente');
            $this->emit('actualizarDisponibilidad');

            $this->resetInput();
        }
    }

    // Resetear los campos del formulario
    public function resetInput()
    {
        $this->dni_placa = '';
        $this->usuario = null;
        $this->registro = null;
        $this->estado_consulta = false;
    }

    // Escuchar los eventos de Livewire
    protected $listeners = ['guardarEntrada', 'guardarSalida'];
}