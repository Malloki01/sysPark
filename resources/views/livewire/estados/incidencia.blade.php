<div class="row layout-top-spacing">
    @if($action == 1)
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5>INCIDENCIAS</h5>
                    </div>
                </div>
            </div>

            @include('common.search')
            @include('common.alerts')

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">ASUNTO</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">FECHA DEL INCIDENTE</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r)
                        <tr>
                            <td>
                                <p class="mb-0">{{$r->id}}</p>
                            </td>
                            <td>{{$r->titulo}}</td>
                            <td>{{$r->descripcion}}</td>
                            <td>{{$r->created_at}}</td>
                            <td>Pendiente</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-info btn-sm" wire:click="abrirModal({{$r->id}})" data-toggle="modal" data-target="#emailModal">
                                        Correo
                                    </button>
                                    <button class="btn btn-primary btn-sm">
                                        Actualizar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$info->links()}}
            </div>

        </div>
    </div>
    @elseif($action == 2)
    @include('livewire.incidencias.form')
    @endif
</div>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Enviar Notificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario dentro del modal -->
                    <div class="form-group">
                        <label for="email">Correo del destinatario:</label>
                        <input type="email" class="form-control" id="email" wire:model.defer="email" placeholder="example@correo.com" required>
                         @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <!-- <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" wire:model="mensaje" rows="4" placeholder="Escribe un mensaje"></textarea>
                        @error('mensaje') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:click="enviarCorreo">Enviar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function Confirm(id) {
        swal({
            title: 'CONFIRMAR',
            text: '¿DESEAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        }, function() {
            console.log('ID', id);
            window.livewire.emit('deleteRow', id);
            toastr.success('info', 'Registro eliminado con éxito');
            swal.close();
        });
    }

</script>

<script>
    window.addEventListener('openModal', () => {
        $('#emailModal').modal('show');
    });

    window.addEventListener('closeModal', () => {
        $('#emailModal').modal('hide');
    });
</script>
