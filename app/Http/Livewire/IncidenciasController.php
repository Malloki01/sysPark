<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Incidencia;

class IncidenciasController extends Component
{
    use WithPagination;

    // public properties
    public $titulo, $descripcion; // campos de la tabla incidencia
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
            $info = Incidencia::where('titulo', 'like', '%' . $this->search . '%')->paginate($this->pagination);

            return view('livewire.incidencias.component', [
                'info' => $info,
            ]);
        } else {
            $info = Incidencia::paginate($this->pagination); // orderBy('descripcion', 'DESC')

            return view('livewire.incidencias.component', [
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
        $this->titulo = '';
        $this->descripcion = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';
    }

    // mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Incidencia::findOrFail($id);
        $this->titulo = $record->titulo;
        $this->descripcion = $record->descripcion;
        $this->selected_id = $record->id;
        $this->action = 2;
    }

    // crear y/o editar elementos
    public function StoreOrUpdate()
    {
        // validar descripcion
        $this->validate([
            'titulo' => 'required|min:4',
            'descripcion' => 'required|min:1',
        ]);

        // validar si existe otro registro con el mismo nombre/descripcion
        if ($this->selected_id > 0) {
            $exists = Incidencia::where('descripcion', $this->descripcion)->where('id', '<>', $this->selected_id)->select('descripcion')->get();
            if ($exists->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con la misma descripcion');
                $this->resetInput();
                return;
            }
        } else {
            $exists = Incidencia::where('descripcion', $this->descripcion)->select('descripcion')->get();
            if ($exists->count() > 0) {
                session()->flash('msg-error', 'Ya existe otro registro con la misma descripcion');
                $this->resetInput();
                return;
            }
        }

        if ($this->selected_id <= 0) {
            // creamos registro
            $record = Incidencia::create([
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion
            ]);
        } else {
            // buscamos el registro
            $record = Incidencia::find($this->selected_id);
            // actualizamos la inf
            $record->update([
                'titulo' => $this->titulo,
                'descripcion' => $this->descripcion
            ]);
        }

        if ($this->selected_id)
            session()->flash('message', 'Incidencia Actualizada');
        else
            session()->flash('message', 'Incidencia Creada');

        $this->resetInput();
    }

    // eliminar registros
    public function destroy($id)
    {
        if ($id) {
            $record = Incidencia::find($id);
            $record->delete();
            $this->resetInput();
        }
    }

    // listeners / escuchar eventos y ejecutar acciones
    protected $listeners = [
        'deleteRow' => 'destroy'
    ];
}
