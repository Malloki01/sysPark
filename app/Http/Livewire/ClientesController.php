<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Cliente;
use App\Mail\RegistroExitoso;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Component
{
    public $dni, $nombres, $apellidos, $tipo,$nro_placa, $telefono, $correo;

    public function render()
    {
        return view('livewire.clientes.component'); // Asegúrate de que esta vista exista
    }


    public function store()
    {
        // Validar los datos
        $this->validate([
            'dni' => 'required|unique:clientes,dni',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'tipo' => 'required|string',
            'nro_placa' => 'nullable|string',
            'telefono' => 'nullable|string',
            'correo' => 'nullable|email|regex:/^[a-zA-Z0-9._%+-]+@([a-zA-Z0-9.-]+\.)?edu\.pe$/',
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'El DNI ya está registrado.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'tipo.required' => 'El tipo de vehículo es obligatorio.',
            'correo.email' => 'El correo electrónico no es válido.',
        ]);

        Cliente::create([
            'dni' => $this->dni,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'tipo' => $this->tipo,
            'nro_placa' => $this->nro_placa ?? null,
            'telefono' => $this->telefono ?? null,
            'correo' => $this->correo ?? null,
        ]);
         
        // Muestra un mensaje de éxito



        //Enviar correo de bienvenida
        Mail::to($this->correo)->send(new RegistroExitoso($this->nombres));

        // Resetear los campos del formulario
        $this->resetInput();
    }
   

    public function cancel()
    {
        //redirigir al inicio de la pagina (welcome.blade.php)
        return redirect()->to('/');
    }

     // Resetear los campos del formulario
     public function resetInput()
     {
            $this->dni = '';
            $this->nombres = '';
            $this->apellidos = '';
            $this->nro_placa = '';
            $this->telefono = '';
            $this->correo = '';
     }



        // Escuchar los eventos de Livewire
        protected $listeners = ['store', 'cancel'];
}
