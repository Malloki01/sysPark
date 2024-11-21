<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SysParking</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="bg-light">
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('images/syslogo.png') }}" alt="SysParking Logo" class="me-2" style="width: 40px; height: 40px;">
                    <span>SysParking</span>
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container d-flex flex-column align-items-center justify-content-center vh-100 text-center">
            <div class="mb-4">
                <img src="{{ asset('images/syslogo.png') }}" alt="Logo Estacionamiento" class="img-fluid" style="width: 19.5rem; height: 19.5rem;">
            </div>
            <h1 class="mb-4" style="font-size: 3rem; font-weight: bold;">Estacionamiento</h1>
            <div class="d-flex flex-column flex-md-row gap-3">
                <a href="{{ url('clientes') }}" class="btn btn-dark btn-lg px-4">Registrarse</a>
                <a href="{{ url('login') }}" class="btn btn-outline-dark btn-lg px-4">Iniciar Sesión</a>
                <!-- Botón para mostrar el modal -->
                <button type="button" class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#disponibilidadModal">
                    Ver Disponibilidad
                </button>
            </div>
        </div>

        <!-- Modal de Disponibilidad -->
        <div class="modal fade" id="disponibilidadModal" tabindex="-1" aria-labelledby="disponibilidadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="disponibilidadModalLabel">Disponibilidad de Vehículos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @livewire('disponibilidad-cond-controller') <!-- Usa el nuevo nombre del componente -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        @livewireScripts
    </body>
</html>