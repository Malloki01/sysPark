<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        @if($action == 1)

        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5>AUTORIZACIÓN</h5>
                    </div>
                </div>
            </div>

            @include('common.search')
            @include('common.alerts')

            <!-- Tabla -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head">
                    <thead>
                        <tr>
                            <th class="text-center">DNI</th>
                            <th class="text-center">NOMBRES</th>
                            <th class="text-center">APELLIDOS</th>
                            <th class="text-center">CORREO</th>
                            <th class="text-center">TELEFONO</th>
                            <th class="text-center">TIPO DE VEHÍCULO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r)
                        <!-- persona -> r -->
                        <tr>
                            <td class="text-center">{{$r->dni}}</td>
                            <td class="text-center">{{$r->nombres}}</td>
                            <td class="text-center">{{$r->apellidos}}</td>
                            <td class="text-center">{{$r->correo}}</td>
                            <td class="text-center">{{$r->telefono}}</td>
                            <td class="text-center">{{$r->tipo}}</td>
                            <td class="text-center">
                                @include('common.actions', ['edit' => 'tipos_edit', 'destroy' => 'tipos_destroy'])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación (donde agregamos el SVG para ocultar el ícono) -->
                <div class="pagination">
                    <!-- Aquí también puedes agregar otros botones de paginación si los tienes -->
                    {{$info->links()}}
                    <style>
                        .pagination svg {
                            display: none;
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>
    @elseif($action == 2)
    @include('livewire.invitados.form') <!-- Formulario para agregar invitados -->
    @endif
</div>

<script>
    function ConfirmEliminar(dni) {
        swal({
            title: 'CONFIRMAR',
            text: '¿DESEAS ELIMINAR A ESTA PERSONA?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        }, function() {
            console.log('dni', dni);
            window.livewire.emit('deleteRow', dni); // Emitimos evento para eliminar
            swal.close(); // Cerramos modal
        });
    }
</script>