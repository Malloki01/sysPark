<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formulario - SysParking</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="http://127.0.0.1:8000/images/syslogo.png" alt="SysParking Logo" class="me-2" style="width: 40px; height: 40px;">
                <span>SysParking</span>
            </a>
        </div>
    </nav>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Formulario -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow">
                    <div class="card-header text-center bg-dark text-white">
                        <h4><b>Formulario</b></h4>
                    </div>
                    <div class="card-body">
                        <!-- Formulario -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" id="dni" class="form-control" wire:model.defer="dni" placeholder="Ingrese el DNI" required>
                                @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" id="nombres" class="form-control" wire:model.defer="nombres" placeholder="Ingrese los nombres" required>
                                @error('nombres') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" id="apellidos" class="form-control" wire:model.defer="apellidos" placeholder="Ingrese los apellidos" required>
                                @error('apellidos') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="correo" class="form-label">Correo Institucional</label>
                                <input type="email" id="correo" class="form-control" wire:model.defer="correo" placeholder="Ingrese el correo" required>
                                @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" id="telefono" class="form-control" wire:model.defer="telefono" placeholder="Ingrese el teléfono" required>
                                @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="tipo" class="form-label">Tipo de Vehículo</label>
                                <select id="tipo" class="form-select" wire:model.defer="tipo" required>
                                    <option value="bicicleta">Bicicleta</option>
                                    <option value="carro">Carro</option>
                                    <option value="moto">Moto</option>
                                    <option value="scooter">Scooter</option>
                                </select>
                                @error('tipo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="nro_placa" class="form-label">Número de Placa</label>
                                <input type="text" id="nro_placa" class="form-control" wire:model.defer="nro_placa" placeholder="Ingrese la placa (opcional)">
                                @error('nro_placa') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" wire:click="cancel" class="btn btn-outline-secondary">
                                &larr; Volver
                            </button>
                            <button onclick="confirmSave()" class="btn btn-dark">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function confirmSave() {
            // Mostrar mensaje de confirmación con SweetAlert2
            Swal.fire({
                title: 'CONFIRMAR',
                text: '¿DESEA GUARDAR EL REGISTRO?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Emitimos el evento de Livewire
                    Livewire.emit('store');
                    // Mostramos el mensaje de éxito con Toastr
                    toastr.success('Registro guardado con éxito');
                }
            });
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Agrega SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
</body>

</html>
