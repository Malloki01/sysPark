<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Cliente;


class DeshabilitadosController extends Component
{
    public $dni, $nombres, $apellidos, $tipo,$nro_placa, $telefono, $correo, $cliente;


    public function render()
    {
        return view('livewire.deshabilitados.component');
    }

    public function validarCliente()
    {

        //Validar dni
        $this->validate([
            'dni' => 'required|max:10',
        ]);
        // Buscar el cliente por DNI
        $this->cliente = Cliente::where('dni', $this->dni)->first();
    }
    
    public function eliminarClienteDNI()
    {
        // Eliminar el cliente por DNI
        Cliente::where('dni', $this->dni)->delete();
        // Mostrar mensaje de éxito
        session()->flash('mensaje', 'Cliente eliminado correctamente');
        // Resetear los campos del formulario
        $this->resetInput();
    }

    // Resetear los campos del formulario
    public function resetInput()
    {
        $this->dni = '';
        $this->nombres = '';
        $this->apellidos = '';
        $this->tipo = '';
        $this->nro_placa = '';
        $this->telefono = '';
        $this->correo = '';
        $this->cliente = '';
    }

    // Escuchar los eventos de Livewire
    protected $listeners = ['eliminarClienteDNI'];
}
