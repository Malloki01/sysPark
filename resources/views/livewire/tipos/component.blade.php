<div class="row layout-top-spacing">
    @if($action == 1)
    <div class="class=col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5>Tipos de Vehículos</h5>
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
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">CREADO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $r)
                        <tr>
                            <td><p class="mb-0">{{$r->id}}</p></td>
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
    @endif

    {{ $info->links() }}
            </div>

        @elseif($action == 2)
            @include('livewire.tipos.form')
        @endif
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('fileChoosen', () => {
                let inputField = document.getElementById('image')
                let file = inputField.files[0]
                let reader = new FileReader();
                reader.onloadend = () => {
                    window.livewire.emit('fileUpload', reader.result)
                }
                reader.readAsDataURL(file);
            });
        });

        window.addEventListener('swal', function(e) {
            Swal.fire(e.detail);
        });

        function Confirm(id) {
            /* let me = this */
            Swal.fire({
                title: 'Confirmar!',
                text: "Deseja Excluir Registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                window.livewire.emit('deleteRow', id)
                if (result.isConfirmed) {
                    //toastr.success('info', 'Registro excluido com sucesso!')
                    swal.close()
                    /* Swal.fire(
                        'Excluido!',
                        'Registro excluido com sucesso!',
                        'success'
                    )  */                   
                }
            })
            /* Swal.fire({
                    title: 'Confirmar',
                    text: 'Deseja Excluir Registro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: false
                },
                function() {
                    console.log('ID', id)
                    window.livewire.emit('deleteRow', id)
                    toastr.success('info', 'Registro eliminado con éxito')
                    swal.close()
                }) */

        }
        document.addEventListener('DOMContentLoaded', function() {
        });

    </script>