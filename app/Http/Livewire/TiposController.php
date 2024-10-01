<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Tipo;

class TiposController extends Component
{
    use WithPagination;

    // public properties
    public $descripcion; // campos de la tabla tipos
    public $selected_id, $search;
    public $action = 1; // permitir movernos entre forms
    private $pagination = 5;

    // es el primero que se ejecuta al iniciarse el componente
    public function mount()
    {
        // inicializar variables / data
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $info = Tipo::where('descripcion', 'like', '%' . $this->search . '%')->paginate($this->pagination);

            return view('livewire.tipos.component', [
                'info' => $info,
            ]);
        } else {
            $info = Tipo::paginate($this->pagination); // orderBy('descripcion', 'DESC')

            return view('livewire.tipos.component', [
                'info' => $info,
            ]);
        }
    }

    // para busquedas con paginacion
    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }

    // movernos entre ventanas
    public function doAction($action)
    {
        $this->action = $action;
        $this->search = '';
    }

    // limpiar properties
    public function resetInput()
    {
        $this->descripcion = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    // mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Tipo::findOrFail($id);
        $this->descripcion = $record->descripcion;
        $this->selected_id = $record->id;
        $this->action = 2;
    }

    // crear y/o editar elementos
    public function StoreOrUpdate()
    {
        // validar descripcion
        $this->validate([
            'descripcion' => 'required|min:4',
        ]);

        // validar si existe otro registro con el mismo nombre/descripcion
        if ($this->selected_id > 0) {
            $exists = Tipo::where('descripcion', $this->descripcion)->where('id', '<>', $this->selected_id)->select('descripcion')->get();
            if ($exists->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con la misma descripcion');
                $this->resetInput();
                return;
            }
        } else {
            $exists = Tipo::where('descripcion', $this->descripcion)->select('descripcion')->get();
            if ($exists->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con la misma descripcion');
                $this->resetInput();
                return;
            }
        }

        if ($this->selected_id <= 0) {
            // creamos registro
            $record = Tipo::create([
                'descripcion' => $this->descripcion
            ]);
        } else {
            // buscamos el registro
            $record = Tipo::find($this->selected_id);
            // actualizamos la inf
            $record->update([
                'descripcion' => $this->descripcion
            ]);
        }

        if ($this->selected_id)
            session()->flash('message', 'Tipo Actualizado');
        else
            session()->flash('message', 'Tipo Creado');

        $this->resetInput();
    }

    // eliminar registros
    public function destroy($id)
    {
        if ($id) {
            $record = Tipo::find($id);
            $record->delete();
            $this->resetInput();
        }
    }

    // listeners / escuchar eventos y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}
