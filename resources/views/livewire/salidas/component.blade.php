<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Salidas</h3>
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
                        <!-- Campo para el DNI o Placa -->
                        <div class="form-group">
                            <label for="dni_placa">DNI o Placa</label>
                            <input type="text" id="dni_placa" class="form-control" placeholder="Ingrese DNI o Placa" wire:model="dni_placa"
                                onkeypress="return validarAlfanumerico(event)" style="text-transform: uppercase;">
                        </div>

                        <!-- Botón para validar el usuario -->
                        <div class="text-center mt-3">
                            <button type="button" wire:click="validarUsuarioSalida" class="btn btn-secondary">Consultar</button>
                        </div>

                        <!-- Mostrar detalles del propietario si se encuentra -->
                        @isset($registro)
                        <div class="mt-3">
                            <p><strong>Propietario:</strong> {{ $registro->nombres }} {{ $registro->apellidos }}</p>
                            @if($registro->nro_placa)
                            <p><strong>Nro de Placa:</strong> {{ $registro->nro_placa }}</p>
                            @endif
                        </div>
                        @endisset

                        <!-- Botón para registrar la entrada -->
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary" onclick="confirmSave()"
                            {{ $estado_consulta ? '' : 'disabled' }}>Guardar
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    function confirmSave() {
        let me = this
        swal({
                title: 'CONFIRMAR',
                text: '¿DESEAS GUARDAR ESTE REGISTRO?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                closeOnConfirm: false
            },
            function() {

                window.livewire.emit('guardarSalida') // Emitimos el evento para Livewire
                toastr.success('info', ' Salida del Vehiculo registrado con éxito')
                swal.close() // Cerramos la alerta modal
            })
    }


    // Función para validar solo letras y números
    function validarAlfanumerico(e) {
        let key = e.key;
        let regex = /^[a-zA-Z0-9-]+$/; // Expresión regular para permitir solo letras y números

        if (!regex.test(key)) {
            e.preventDefault(); // Evita que el carácter no permitido se ingrese
            return false;
        }
        return true;
    }
</script>