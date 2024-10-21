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
                            <td class="text-center">
                                @include('common.actions')
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

<script type="text/javascript">
   function Confirm(id) {
            let me = this
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
                },
                function() {
                    console.log('ID', id);
                    window.livewire.emit('deleteRow', id) //emitimos evento deleteRow
                    toastr.success('info', 'Registro eliminado con éxito') //mostramos mensaje de confirmación
                    swal.close() //cerramos la modal
                })
        }
</script>
