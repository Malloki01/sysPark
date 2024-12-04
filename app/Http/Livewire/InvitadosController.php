<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Invitado;
use App\Cliente;

class InvitadosController extends Component
{
    use WithPagination;

    // Public properties
    public $dni, $nombres, $apellidos, $tipo, $telefono, $correo, $nro_placa, $autorizado, $estado;
    public $selected_id, $search;
    public $action = 1; // For switching views
    private $pagination = 5;

    // Mount method
    public function mount()
    {
        // Initialize data if needed
        $this->resetInput();
    }

    // Render the component
    public function render()
    {
        if (strlen($this->search) > 0) {
            $info = Invitado::where('nombres', 'like', '%' . $this->search . '%')
                ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                ->orWhere('dni', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
        } else {
            $info = Invitado::paginate($this->pagination);
        }

        return view('livewire.invitados.component', [
            'info' => $info,
        ]);
    }

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function doAction($action)
    {
        $this->resetInput();
        $this->action = $action;
    }

    // Reset form input fields
    public function resetInput()
    {
        $this->dni = '';
        $this->nombres = '';
        $this->apellidos = '';
        $this->tipo = '';
        $this->correo = ''; // Limpia el correo
        $this->telefono = ''; // Limpia el teléfono
        $this->nro_placa = ''; // Limpia el nro_placa
        $this->estado = ''; // Limpia el estado
        
        $this->autorizado = false;
        $this->selected_id = null;
        $this->search = '';
        $this->action = 1;
    }

    // Edit an existing record
    public function edit($id)
    {
        $record = Invitado::findOrFail($id);
        $this->dni = $record->dni;
        $this->nombres = $record->nombres;
        $this->apellidos = $record->apellidos;
        $this->tipo = $record->tipo;
        $this->correo = $record->correo;
        $this->telefono = $record->telefono;
        $this->nro_placa = $record->nro_placa;

        $this->autorizado = $record->autorizado;
        $this->selected_id = $record->id;
        $this->action = 2;
    }

    // Create or update a record
    public function storeOrUpdate()
    {
        $this->validate([
            'dni' => 'required|unique:invitados,dni,' . $this->selected_id,
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            'telefono' => 'required|numeric',
            'tipo' => 'required',
            
            'correo' => 'required|email',
        ]);
        // Clientes : 'dni', 'nombres', 'apellidos', 'nro_placa', 'tipo', 'correo', 'telefono'
        if ($this->selected_id <= 0) {
            Cliente::create([
                'dni' => $this->dni,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'telefono' => $this->telefono,
                'tipo' => $this->tipo,
                'correo' => $this->correo,
                'nro_placa' => $this->nro_placa ?: null, // Si está vacío, asigna null
            ]);
    
            session()->flash('message', 'Cliente creado correctamente');
        } else {
            $record = Cliente::find($this->selected_id);
            $record->update([
                'dni' => $this->dni,
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'tipo' => $this->tipo,
                'telefono' => $this->telefono,
                'autorizado' => $this->autorizado,
                'correo' => $this->correo,
                'nro_placa' => $this->nro_placa ?: null, // Asigna null si está vacío

                'estado' => '0', 
            ]);
    
            session()->flash('message', 'Cliente actualizado correctamente');
        }
    
        $this->resetInput();
    }
    

    // Authorize an invited person
    public function autorizar($id)
    {
        $record = Invitado::find($id);
        if ($record) {
            $record->autorizado = true;
            $record->save();

            session()->flash('message', 'Invitado autorizado correctamente');
        }
    }

    // Delete a record
    public function destroy($id)
    {
        if ($id) {
            $record = Invitado::find($id);
            $record->delete();

            session()->flash('message', 'Invitado eliminado correctamente');
            $this->resetInput();
        }
    }

    // Listeners for events
    protected $listeners = ['deleteRow' => 'destroy',
        'autorizarInvitado' => 'autorizar',
    ];
}
