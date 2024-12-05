<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;


class UsuarioController extends Component
{
    use WithPagination;

    public $tipo = "Elegir", $nombre, $telefono, $movil, $email, $direccion, $password;
    public $selected_id, $search;
    public $action = 1, $pagination = 5;


    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $info = User::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('telefono', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
            return view('livewire.usuarios.component', ['info' => $info]);
        }
        else {
            $info = User::orderBy('id', 'desc')
                ->paginate($this->pagination);
            return view('livewire.usuarios.component', ['info' => $info]);
        }
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

    public function resetInput()
    {
        $this->nombre = '';
        $this->tipo = 'Elegir';
        $this->telefono = '';
        $this->movil = '';
        $this->email = '';
        $this->direccion = '';
        $this->password = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    public function edit($id)
    {
        $record = User::find($id);

        $this->nombre = $record->nombre;
        $this->telefono = $record->telefono;
        $this->movil = $record->movil;
        $this->direccion = $record->direccion;
        $this->email = $record->email;
        $this->tipo = $record->tipo;
        $this->selected_id = $record->id;
        $this->action = 2;
    }

    public function StoreOrUpdate()
    {
        $this->validate([
            'nombre' => 'required',
            //Si no es un update, entonces se valida el password
            'password' => $this->selected_id <= 0 ? 'required' : '',
            'email' => 'required|email',
            'tipo' => 'not_in:Elegir',
            'tipo' => 'required'
        ]);

        if ($this->selected_id <= 0)
        {
            $user = User::create([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'movil' => $this->movil,
                'tipo' => $this->tipo,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'password' => $this->password
            ]);
        }
        else {
            $user = User::find($this->selected_id);
            $user->update([
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'movil' => $this->movil,
                'tipo' => $this->tipo,
                'email' => $this->email,
                'direccion' => $this->direccion,
                // 'password' => bcrypt($this->password)
            ]);
        }
        
        if ($this->selected_id)
            $this->emit('msgok', 'Usuario Actualizado con Éxito');
        else
            $this->emit('msgok', 'Usuario fue creado con Éxito');
        
        $this->resetInput();
    }

    // Agregado 14:10
    public $listeners = [
        'deleteRow' => 'destroy'
    ];


    public function destroy($id) // eliminar / delete / remove
    {
        if($id) {
            $record = User::where('id', $id);
            $record->delete();
            $this->resetInput();
            $this->emit('msgok', 'Registro eliminado con éxito');
        }
    
    }

    
    
}    