<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>DESHABILITAR CLIENTES</h3>
                </div>
                <div class="card-body">
                    <!-- Mostrar mensajes de éxito o error -->
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Campo para el DNI -->
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" id="dni" class="form-control" placeholder="Ingrese DNI" wire:model="dni"
                            onkeypress="return validarAlfanumerico(event)" style="text-transform: uppercase;">
                    </div>

                    <!-- Botón para validar el usuario -->
                    <div class="text-center mt-3">
                        <button type="button" wire:click="validarCliente" class="btn btn-secondary">Consultar</button>
                    </div>

                    <!-- Mostrar detalles del propietario si se encuentra -->
                    @if(isset($cliente) && $cliente)
                    <div class="mt-3">
                        <p><strong>Propietario:</strong> {{ $cliente->nombres}} {{ $cliente->apellidos }}</p>
                        <p><strong>Tipo:</strong> {{ $cliente->tipo}}
                        <p><strong>Telefono:</strong> {{ $cliente->telefono}}
                        <p><strong>correo:</strong> {{ $cliente->correo}}
                        @if($cliente->nro_placa)
                        <p><strong>Nro de Placa:</strong> {{ $cliente->nro_placa }}</p>
                        @endif
                    </div>
                    @endif

                    <!-- Botón para deshabilitar el usuario -->
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-danger" onclick="confirmDisable()">
                        Deshabilitar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmDisable() {
        swal({
                title: 'CONFIRMAR',
                text: '¿DESEAS DESHABILITAR A ESTE USUARIO?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {
                window.livewire.emit('eliminarClienteDNI')
                toastr.success('Cliente deshabilitado con éxito')
                swal.close()
            })
    }

    function validarAlfanumerico(e) {
        let key = e.key;
        let regex = /^[a-zA-Z0-9-]+$/;
        if (!regex.test(key)) {
            e.preventDefault();
            return false;
        }
        return true;
    }
</script>