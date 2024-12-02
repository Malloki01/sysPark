<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Incidencia;

use App\Mail\NotificacionIncidencia;
use Illuminate\Support\Facades\Mail;


class EstadosController extends Component
{
    use WithPagination;

    // public properties
    public $titulo, $descripcion; // campos de la tabla incidencia
    public $selected_id, $search;
    public $action = 1; // permitir movernos entre forms
    private $pagination = 5;
    //Enviar correo de notificación
    public $email;


    // es el primero que se ejecuta al iniciarse el componente
    public function mount()
    {
        // inicializar variables / data
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $info = Incidencia::where('titulo', 'like', '%' . $this->search . '%')->paginate($this->pagination);

            return view('livewire.estados.incidencia', [
                'info' => $info,
            ]);
        } else {
            $info = Incidencia::paginate($this->pagination); // orderBy('descripcion', 'DESC')

            return view('livewire.estados.incidencia', [
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

    //Mandar Correo
    public function enviarCorreo()
    {
        // Validar los datos
        $this->validate([
            'email' => 'required|email',
        ]);

        // Enviar correo de notificación
        Mail::to($this->email)->send(new NotificacionIncidencia());

        // Mostrar mensaje de éxito
        session()->flash('mensaje', 'Correo enviado correctamente');

        // Resetear los campos del formulario
        $this->reset(['email']);

        // Emitir evento para cerrar el modal
        $this->dispatchBrowserEvent('closeModal');
    }

    public function abrirModal($id)
    {
        $this->selected_id = $id; // Guarda el ID de la incidencia seleccionada
        $this->reset(['email']); // Limpia los campos del formulario
        $this->dispatchBrowserEvent('openModal'); // Emite un evento para abrir el modal
    }

    // listeners / escuchar eventos y ejecutar acciones
    protected $listeners = ['enviarCorreo' => 'enviarCorreo'];
}
